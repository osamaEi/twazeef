@extends('dashboard.index')

@section('content')
<div class="chat-container">
    <div class="chat-sidebar">
        <div class="chat-sidebar-header">
            <div class="chat-search">
                <input type="text" id="chat-search-input" placeholder="ابحث عن محادثة...">
                <i class="fas fa-search"></i>
            </div>
            <div class="chat-filter-tabs">
                <button class="filter-tab active">الكل</button>
                <button class="filter-tab">غير مقروءة</button>
                <button class="filter-tab">مؤرشفة</button>
            </div>
        </div>
        
        <div class="chat-list" id="chat-list">
            @foreach($chats as $chat)
            <div class="chat-item" data-chat-id="{{ $chat['id'] }}">
                <div class="chat-avatar">
                    <div class="avatar-placeholder">{{ $chat['initials'] }}</div>
                    <div class="status-indicator {{ $chat['online_status'] }}"></div>
                </div>
                <div class="chat-info">
                    <div class="chat-name">{{ $chat['name'] }}</div>
                    <div class="chat-last-message">{{ $chat['last_message'] }}</div>
                </div>
                <div class="chat-time">{{ $chat['last_message_time'] }}</div>
                @if($chat['unread_count'] > 0)
                <div class="unread-badge">{{ $chat['unread_count'] }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    
    <div class="chat-main">
        <div class="chat-header" id="chat-header" style="display: none;">
            <div class="chat-avatar">
                <div class="avatar-placeholder" id="chat-header-avatar"></div>
                <div class="status-indicator" id="chat-header-status"></div>
            </div>
            <div class="chat-header-info">
                <div class="chat-header-name" id="chat-header-name"></div>
                <div class="chat-header-status" id="chat-header-status-text"></div>
            </div>
            <div class="chat-header-actions">
                <button class="chat-header-btn" title="مكالمة صوتية">
                    <i class="fas fa-phone"></i>
                </button>
                <button class="chat-header-btn" title="مكالمة فيديو">
                    <i class="fas fa-video"></i>
                </button>
                <button class="chat-header-btn" title="معلومات المحادثة">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>
        </div>
        
        <div class="messages-container" id="messages-container">
            <div class="text-center" style="padding: 2rem; color: var(--grey-500);">
                اختر محادثة لبدء المراسلة
            </div>
        </div>
        
        <!-- New messages indicator -->
        <div class="new-messages-indicator" id="new-messages-indicator" style="display: none;">
            <i class="fas fa-arrow-down"></i>
            <span>رسائل جديدة</span>
        </div>
        
        <div class="chat-input-container" id="chat-input-container" style="display: none;">
            <div class="chat-input-wrapper">
                <textarea class="chat-input" id="message-input" placeholder="اكتب رسالتك هنا..." rows="1"></textarea>
                <div class="chat-input-actions">
                    <input type="file" id="file-input" style="display: none;" accept="*/*">
                    <button class="input-action-btn" id="file-btn" title="إرفاق ملف">
                        <i class="fas fa-paperclip"></i>
                    </button>
                    <input type="file" id="image-input" style="display: none;" accept="image/*">
                    <button class="input-action-btn" id="image-btn" title="إرسال صورة">
                        <i class="fas fa-image"></i>
                    </button>
                    <button class="input-action-btn" id="voice-btn" title="تسجيل صوتي">
                        <i class="fas fa-microphone"></i>
                    </button>
                    <button class="input-action-btn send-btn" id="send-button" title="إرسال">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
            <!-- Voice recording interface -->
            <div class="voice-recording" id="voice-recording" style="display: none;">
                <div class="voice-controls">
                    <div class="recording-indicator">
                        <div class="pulse"></div>
                        <span>جاري التسجيل...</span>
                    </div>
                    <div class="recording-time" id="recording-time">00:00</div>
                    <div class="recording-actions">
                        <button class="recording-btn stop-btn" id="stop-recording">
                            <i class="fas fa-stop"></i>
                        </button>
                        <button class="recording-btn send-btn" id="send-recording">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
class ChatSystem {
    constructor() {
        this.currentChatId = null;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        this.mediaRecorder = null;
        this.audioChunks = [];
        this.recordingStartTime = null;
        this.recordingTimer = null;
        this.lastMessageId = 0;
        this.pollingInterval = null;
        this.isPolling = false;
        this.init();
    }

    init() {
        this.bindEvents();
        console.log('Chat system initialized');
    }

    bindEvents() {
        // Chat item selection
        document.addEventListener('click', (e) => {
            const chatItem = e.target.closest('.chat-item');
            if (chatItem) {
                const chatId = chatItem.dataset.chatId;
                this.selectChat(chatId, chatItem);
            }
        });

        // Send message
        document.getElementById('send-button').addEventListener('click', () => {
            this.sendMessage();
        });

        // Enter key to send message
        document.getElementById('message-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });

        // Auto-resize textarea
        document.getElementById('message-input').addEventListener('input', (e) => {
            e.target.style.height = 'auto';
            e.target.style.height = Math.min(e.target.scrollHeight, 120) + 'px';
        });

        // Chat search
        document.getElementById('chat-search-input').addEventListener('input', (e) => {
            this.searchChats(e.target.value);
        });

        // File upload handlers
        document.getElementById('file-btn').addEventListener('click', () => {
            document.getElementById('file-input').click();
        });

        document.getElementById('image-btn').addEventListener('click', () => {
            document.getElementById('image-input').click();
        });

        document.getElementById('file-input').addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                this.uploadFile(e.target.files[0], 'file');
            }
        });

        document.getElementById('image-input').addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                this.uploadFile(e.target.files[0], 'image');
            }
        });

        // Voice recording handlers
        document.getElementById('voice-btn').addEventListener('click', () => {
            this.startVoiceRecording();
        });

        document.getElementById('stop-recording').addEventListener('click', () => {
            this.stopVoiceRecording();
        });

        document.getElementById('send-recording').addEventListener('click', () => {
            this.sendVoiceRecording();
        });

        // Cleanup when page is unloaded
        window.addEventListener('beforeunload', () => {
            this.stopPolling();
            if (this.mediaRecorder && this.mediaRecorder.state === 'recording') {
                this.mediaRecorder.stop();
            }
        });

        // Hide new messages indicator when scrolling to bottom
        document.getElementById('messages-container').addEventListener('scroll', () => {
            const container = document.getElementById('messages-container');
            const isAtBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - 100;
            
            if (isAtBottom) {
                this.hideNewMessagesIndicator();
            }
        });
    }

    async selectChat(chatId, chatElement) {
        try {
            // Stop polling for previous chat
            this.stopPolling();

            // Update UI
            document.querySelectorAll('.chat-item').forEach(item => {
                item.classList.remove('active');
            });
            chatElement.classList.add('active');

            // Remove unread badge
            const unreadBadge = chatElement.querySelector('.unread-badge');
            if (unreadBadge) {
                unreadBadge.remove();
            }

            this.currentChatId = chatId;

            // Show loading state
            this.showLoadingMessages();

            // Fetch chat data
            const response = await fetch(`/chat/${chatId}`, {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            
            // Update chat header
            this.updateChatHeader(data.chat);
            
            // Display messages
            this.displayMessages(data.messages);
            
            // Show input area
            document.getElementById('chat-input-container').style.display = 'block';

            // Mark as read
            await this.markAsRead(chatId);

            // Start polling for new messages
            this.startPolling(chatId);

        } catch (error) {
            console.error('Error loading chat:', error);
            this.showError('حدث خطأ في تحميل المحادثة');
        }
    }

    updateChatHeader(chat) {
        document.getElementById('chat-header').style.display = 'flex';
        document.getElementById('chat-header-avatar').textContent = chat.initials;
        document.getElementById('chat-header-name').textContent = chat.name;
        
        const statusElement = document.getElementById('chat-header-status');
        statusElement.className = 'status-indicator ' + chat.online_status;
        
        const statusText = {
            'online': 'متصل الآن',
            'away': 'غير متاح',
            'offline': 'غير متصل'
        };
        
        document.getElementById('chat-header-status-text').innerHTML = `
            <div class="status-indicator ${chat.online_status}"></div>
            ${statusText[chat.online_status]}
        `;
    }

    displayMessages(messages) {
        const container = document.getElementById('messages-container');
        
        if (messages.length === 0) {
            container.innerHTML = `
                <div class="text-center" style="padding: 2rem; color: var(--grey-500);">
                    لا توجد رسائل في هذه المحادثة
                </div>
            `;
            this.lastMessageId = 0;
            return;
        }

        // If container is empty, clear it first
        if (container.children.length === 1 && container.children[0].classList.contains('text-center')) {
            container.innerHTML = '';
        }

        messages.forEach(message => {
            const messageElement = this.createMessageElement(message);
            container.appendChild(messageElement);
            
            // Update last message ID
            if (message.id > this.lastMessageId) {
                this.lastMessageId = message.id;
            }
        });

        this.scrollToBottom();
    }

    createMessageElement(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${message.is_own ? 'sent' : 'received'}`;
        
        let avatarHtml = '';
        if (!message.is_own) {
            avatarHtml = `
                <div class="message-avatar avatar-placeholder">
                    ${message.user_initials}
                </div>
            `;
        }

        messageDiv.innerHTML = `
            ${avatarHtml}
            <div class="message-content">
                ${this.formatMessageContent(message)}
                <div class="message-time">${message.formatted_time}</div>
            </div>
        `;

        return messageDiv;
    }

    formatMessageContent(message) {
        if (message.type === 'file') {
            return `
                <div class="message-file">
                    <div class="file-icon">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="file-info">
                        <div class="file-name">${message.metadata?.name || 'ملف'}</div>
                        <div class="file-size">${message.metadata?.size || ''}</div>
                    </div>
                    <a href="${message.metadata?.url}" download class="file-download">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            `;
        }

        if (message.type === 'image') {
            return `
                <img src="${message.metadata?.url}" class="message-image" alt="صورة" onclick="this.classList.toggle('expanded')">
            `;
        }

        if (message.type === 'voice') {
            return `
                <div class="message-voice">
                    <audio controls class="voice-player">
                        <source src="${message.metadata?.url}" type="${message.metadata?.mime_type || 'audio/webm'}">
                        متصفحك لا يدعم تشغيل الملفات الصوتية.
                    </audio>
                    <div class="voice-info">
                        <span class="voice-duration">${message.metadata?.duration || ''}</span>
                    </div>
                </div>
            `;
        }

        return message.content;
    }

    async sendMessage() {
        const input = document.getElementById('message-input');
        const content = input.value.trim();
        
        if (!content || !this.currentChatId) return;

        try {
            // Clear input immediately
            input.value = '';
            input.style.height = 'auto';

            // Send message
            const response = await fetch(`/chat/${this.currentChatId}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    content: content,
                    type: 'text'
                })
            });

            const data = await response.json();
            
            // Add message to UI
            const messageElement = this.createMessageElement(data.message);
            document.getElementById('messages-container').appendChild(messageElement);
            this.scrollToBottom();

            // Update last message ID to prevent polling from adding it again
            this.lastMessageId = data.message.id;

            // Update chat list
            this.updateChatInList(this.currentChatId, content, data.message.formatted_time);

        } catch (error) {
            console.error('Error sending message:', error);
            this.showError('فشل في إرسال الرسالة');
            input.value = content; // Restore content
        }
    }

    updateChatInList(chatId, lastMessage, time) {
        const chatItem = document.querySelector(`[data-chat-id="${chatId}"]`);
        if (chatItem) {
            chatItem.querySelector('.chat-last-message').textContent = lastMessage;
            chatItem.querySelector('.chat-time').textContent = time;
            
            // Move to top of list
            const chatList = document.getElementById('chat-list');
            chatList.insertBefore(chatItem, chatList.firstChild);
        }
    }

    async markAsRead(chatId) {
        try {
            await fetch(`/chat/${chatId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });
        } catch (error) {
            console.error('Error marking as read:', error);
        }
    }

    async searchChats(query) {
        if (query.length < 2) {
            this.loadAllChats();
            return;
        }

        try {
            const response = await fetch(`/api/chat/search?q=${encodeURIComponent(query)}`, {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });

            const chats = await response.json();
            this.updateChatList(chats);
        } catch (error) {
            console.error('Error searching chats:', error);
        }
    }

    updateChatList(chats) {
        const chatList = document.getElementById('chat-list');
        chatList.innerHTML = '';

        chats.forEach(chat => {
            const chatItem = this.createChatListItem(chat);
            chatList.appendChild(chatItem);
        });
    }

    createChatListItem(chat) {
        const chatDiv = document.createElement('div');
        chatDiv.className = 'chat-item';
        chatDiv.dataset.chatId = chat.id;

        chatDiv.innerHTML = `
            <div class="chat-avatar">
                <div class="avatar-placeholder">${chat.initials}</div>
                <div class="status-indicator ${chat.online_status}"></div>
            </div>
            <div class="chat-info">
                <div class="chat-name">${chat.name}</div>
                <div class="chat-last-message">${chat.last_message}</div>
            </div>
            <div class="chat-time">${chat.last_message_time || ''}</div>
            ${chat.unread_count > 0 ? `<div class="unread-badge">${chat.unread_count}</div>` : ''}
        `;

        return chatDiv;
    }

    loadAllChats() {
        // Reload the original chat list
        location.reload();
    }

    showLoadingMessages() {
        const container = document.getElementById('messages-container');
        container.innerHTML = `
            <div class="text-center" style="padding: 2rem; color: var(--grey-500);">
                <i class="fas fa-spinner fa-spin"></i>
                جاري التحميل...
            </div>
        `;
    }

    scrollToBottom() {
        const container = document.getElementById('messages-container');
        container.scrollTop = container.scrollHeight;
    }

    showError(message) {
        // Create and show error notification
        const notification = document.createElement('div');
        notification.className = 'alert alert-error';
        notification.style.cssText = `
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 10000;
            background: #f44336;
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;
        notification.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i>
            <span>${message}</span>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    async uploadFile(file, type) {
        if (!this.currentChatId) {
            this.showError('يرجى اختيار محادثة أولاً');
            return;
        }

        // Validate file size (max 10MB)
        if (file.size > 10 * 1024 * 1024) {
            this.showError('حجم الملف كبير جداً. الحد الأقصى 10 ميجابايت');
            return;
        }

        try {
            const formData = new FormData();
            formData.append('file', file);
            formData.append('type', type);
            formData.append('content', file.name);

            const response = await fetch(`/chat/${this.currentChatId}/messages`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();
            
            // Add message to UI
            const messageElement = this.createMessageElement(data.message);
            document.getElementById('messages-container').appendChild(messageElement);
            this.scrollToBottom();

            // Update last message ID to prevent polling from adding it again
            this.lastMessageId = data.message.id;

            // Update chat list
            this.updateChatInList(this.currentChatId, data.message.content, data.message.formatted_time);

        } catch (error) {
            console.error('Error uploading file:', error);
            this.showError('فشل في رفع الملف');
        }
    }

    async startVoiceRecording() {
        try {
            // Check if MediaRecorder is supported
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                this.showError('المتصفح لا يدعم التسجيل الصوتي');
                return;
            }

            const stream = await navigator.mediaDevices.getUserMedia({ 
                audio: {
                    echoCancellation: true,
                    noiseSuppression: true,
                    sampleRate: 44100
                } 
            });
            
            // Check if MediaRecorder supports the audio format
            let mimeType = 'audio/webm';
            if (!MediaRecorder.isTypeSupported(mimeType)) {
                mimeType = 'audio/mp4';
                if (!MediaRecorder.isTypeSupported(mimeType)) {
                    mimeType = 'audio/wav';
                }
            }

            this.mediaRecorder = new MediaRecorder(stream, { mimeType });
            this.audioChunks = [];

            this.mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    this.audioChunks.push(event.data);
                }
            };

            this.mediaRecorder.onstop = () => {
                // Stop all tracks
                stream.getTracks().forEach(track => track.stop());
            };

            this.mediaRecorder.start(1000); // Collect data every second
            this.recordingStartTime = Date.now();
            
            // Show recording interface
            document.getElementById('voice-recording').style.display = 'block';
            document.getElementById('voice-btn').style.display = 'none';
            
            // Start timer
            this.recordingTimer = setInterval(() => {
                const elapsed = Math.floor((Date.now() - this.recordingStartTime) / 1000);
                const minutes = Math.floor(elapsed / 60).toString().padStart(2, '0');
                const seconds = (elapsed % 60).toString().padStart(2, '0');
                document.getElementById('recording-time').textContent = `${minutes}:${seconds}`;
            }, 1000);

        } catch (error) {
            console.error('Error starting recording:', error);
            if (error.name === 'NotAllowedError') {
                this.showError('تم رفض الوصول للميكروفون. يرجى السماح بالوصول في إعدادات المتصفح');
            } else if (error.name === 'NotFoundError') {
                this.showError('لم يتم العثور على ميكروفون');
            } else {
                this.showError('فشل في بدء التسجيل. تأكد من السماح بالوصول للميكروفون');
            }
        }
    }

    stopVoiceRecording() {
        if (this.mediaRecorder && this.mediaRecorder.state === 'recording') {
            this.mediaRecorder.stop();
            this.mediaRecorder.stream.getTracks().forEach(track => track.stop());
            
            clearInterval(this.recordingTimer);
            
            // Hide recording interface
            document.getElementById('voice-recording').style.display = 'none';
            document.getElementById('voice-btn').style.display = 'flex';
        }
    }

    async sendVoiceRecording() {
        if (this.audioChunks.length === 0) {
            this.showError('لا يوجد تسجيل صوتي');
            return;
        }

        try {
            // Determine the correct MIME type and file extension
            let mimeType = 'audio/webm';
            let fileExtension = 'webm';
            
            if (this.mediaRecorder && this.mediaRecorder.mimeType) {
                mimeType = this.mediaRecorder.mimeType;
                if (mimeType.includes('mp4')) {
                    fileExtension = 'mp4';
                } else if (mimeType.includes('wav')) {
                    fileExtension = 'wav';
                }
            }

            const audioBlob = new Blob(this.audioChunks, { type: mimeType });
            
            // Validate file size (max 10MB)
            if (audioBlob.size > 10 * 1024 * 1024) {
                this.showError('حجم التسجيل الصوتي كبير جداً. الحد الأقصى 10 ميجابايت');
                return;
            }

            const formData = new FormData();
            formData.append('voice', audioBlob, `voice-recording.${fileExtension}`);
            formData.append('type', 'voice');
            formData.append('content', 'رسالة صوتية');

            const response = await fetch(`/chat/${this.currentChatId}/messages`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            
            // Add message to UI
            const messageElement = this.createMessageElement(data.message);
            document.getElementById('messages-container').appendChild(messageElement);
            this.scrollToBottom();

            // Update last message ID to prevent polling from adding it again
            this.lastMessageId = data.message.id;

            // Update chat list
            this.updateChatInList(this.currentChatId, data.message.content, data.message.formatted_time);

            // Reset recording
            this.audioChunks = [];
            this.recordingStartTime = null;

        } catch (error) {
            console.error('Error sending voice recording:', error);
            this.showError('فشل في إرسال التسجيل الصوتي');
        }
    }

    startPolling(chatId) {
        // Stop any existing polling
        this.stopPolling();
        
        this.isPolling = true;
        this.pollingInterval = setInterval(async () => {
            if (this.currentChatId === chatId && this.isPolling) {
                await this.checkForNewMessages(chatId);
            }
        }, 2000); // Poll every 2 seconds
    }

    stopPolling() {
        this.isPolling = false;
        if (this.pollingInterval) {
            clearInterval(this.pollingInterval);
            this.pollingInterval = null;
        }
    }

    async checkForNewMessages(chatId) {
        try {
            const response = await fetch(`/chat/${chatId}/messages/new?last_message_id=${this.lastMessageId}`, {
                headers: {
                    'X-CSRF-TOKEN': this.csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            
            if (data.messages && data.messages.length > 0) {
                // Check if user is at bottom of messages
                const container = document.getElementById('messages-container');
                const isAtBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - 100;
                
                // Add new messages to the UI
                data.messages.forEach(message => {
                    const messageElement = this.createMessageElement(message);
                    container.appendChild(messageElement);
                    
                    // Update last message ID
                    if (message.id > this.lastMessageId) {
                        this.lastMessageId = message.id;
                    }
                });

                // Only auto-scroll if user is at bottom, otherwise show indicator
                if (isAtBottom) {
                    this.scrollToBottom();
                } else {
                    this.showNewMessagesIndicator();
                }
                
                // Mark as read if not own messages
                const hasNewMessages = data.messages.some(msg => !msg.is_own);
                if (hasNewMessages) {
                    await this.markAsRead(chatId);
                }
            }

            // Update last message ID from response
            if (data.last_message_id > this.lastMessageId) {
                this.lastMessageId = data.last_message_id;
            }

        } catch (error) {
            console.error('Error checking for new messages:', error);
        }
    }

    showNewMessagesIndicator() {
        const indicator = document.getElementById('new-messages-indicator');
        indicator.style.display = 'flex';
        
        // Add click handler to scroll to bottom
        indicator.onclick = () => {
            this.scrollToBottom();
            this.hideNewMessagesIndicator();
        };
    }

    hideNewMessagesIndicator() {
        const indicator = document.getElementById('new-messages-indicator');
        indicator.style.display = 'none';
    }
}

// Initialize chat system when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ChatSystem();
});
</script>

<style>
/* Chat System Styles */
:root {
    --primary-green: #003c6d;
    --primary-light: #005085;
    --primary-lighter: #e8eff5;
    --primary-lightest: #f4f9fa;
    --primary-dark: #003655;
    --primary-darker: #003858;
    --pure-white: #FFFFFF;
    --grey-900: #1a1a1a;
    --grey-700: #424242;
    --grey-500: #757575;
    --grey-300: #e0e0e0;
    --grey-100: #f5f5f5;
    --grey-50: #fafafa;
    --message-sent: #003c6d;
    --message-received: #f0f2f5;
    --online-status: #4caf50;
    --away-status: #ff9800;
    --offline-status: #9e9e9e;
    --font-main: 'Neo Sans Arabic', sans-serif;
    --sidebar-width: 340px;
    --header-height: 90px;
    --border-radius-sm: 12px;
    --border-radius-md: 20px;
    --shadow-sm: 0 2px 8px rgba(0, 69, 109, 0.08);
    --shadow-md: 0 6px 20px rgba(0, 60, 109, 0.12);
    --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.chat-container {
    display: flex;
    height: calc(100vh - var(--header-height) - 2rem);
    background: var(--pure-white);
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    margin: 1rem;
}

.chat-sidebar {
    width: var(--sidebar-width);
    background: var(--grey-50);
    border-left: 1px solid var(--grey-300);
    display: flex;
    flex-direction: column;
}

.chat-sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--grey-300);
    background: var(--pure-white);
}

.chat-search {
    position: relative;
    margin-bottom: 1rem;
}

.chat-search input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--grey-300);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    background: var(--grey-50);
    transition: var(--transition-fast);
}

.chat-search input:focus {
    outline: none;
    border-color: var(--primary-green);
    background: var(--pure-white);
    box-shadow: 0 0 0 3px rgba(0, 60, 109, 0.1);
}

.chat-search i {
    position: absolute;
    left: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--grey-500);
    font-size: 0.875rem;
}

.chat-filter-tabs {
    display: flex;
    gap: 0.5rem;
}

.filter-tab {
    padding: 0.5rem 1rem;
    border: none;
    background: transparent;
    color: var(--grey-500);
    font-size: 0.75rem;
    border-radius: 6px;
    cursor: pointer;
    transition: var(--transition-fast);
}

.filter-tab.active,
.filter-tab:hover {
    background: var(--primary-green);
    color: var(--pure-white);
}

.chat-list {
    flex: 1;
    overflow-y: auto;
    padding: 0.5rem 0;
}

.chat-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    cursor: pointer;
    transition: var(--transition-fast);
    border-bottom: 1px solid var(--grey-100);
    position: relative;
}

.chat-item:hover {
    background: var(--primary-lightest);
}

.chat-item.active {
    background: var(--primary-lighter);
    border-right: 3px solid var(--primary-green);
}

.chat-avatar {
    position: relative;
    margin-left: 1rem;
}

.avatar-placeholder {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--primary-green);
    color: var(--pure-white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid var(--pure-white);
}

.status-indicator.online {
    background: var(--online-status);
}

.status-indicator.away {
    background: var(--away-status);
}

.status-indicator.offline {
    background: var(--offline-status);
}

.chat-info {
    flex: 1;
    min-width: 0;
}

.chat-name {
    font-weight: 600;
    color: var(--grey-900);
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.chat-last-message {
    color: var(--grey-500);
    font-size: 0.75rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.chat-time {
    color: var(--grey-500);
    font-size: 0.75rem;
    margin-left: 0.5rem;
}

.unread-badge {
    position: absolute;
    top: 0.75rem;
    right: 1rem;
    background: var(--primary-green);
    color: var(--pure-white);
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.625rem;
    font-weight: 600;
}

.chat-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: var(--pure-white);
}

.chat-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--grey-300);
    display: flex;
    align-items: center;
    background: var(--pure-white);
}

.chat-header-info {
    flex: 1;
    margin-left: 1rem;
}

.chat-header-name {
    font-weight: 600;
    color: var(--grey-900);
    margin-bottom: 0.25rem;
}

.chat-header-status {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--grey-500);
    font-size: 0.75rem;
}

.chat-header-actions {
    display: flex;
    gap: 0.5rem;
}

.chat-header-btn {
    width: 36px;
    height: 36px;
    border: none;
    background: var(--grey-100);
    color: var(--grey-500);
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
}

.chat-header-btn:hover {
    background: var(--primary-green);
    color: var(--pure-white);
}

.messages-container {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.message {
    display: flex;
    gap: 0.75rem;
    max-width: 70%;
}

.message.sent {
    align-self: flex-end;
    flex-direction: row-reverse;
}

.message.received {
    align-self: flex-start;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--primary-green);
    color: var(--pure-white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.75rem;
    flex-shrink: 0;
}

.message-content {
    background: var(--message-received);
    padding: 0.75rem 1rem;
    border-radius: var(--border-radius-sm);
    position: relative;
}

.message.sent .message-content {
    background: var(--message-sent);
    color: var(--pure-white);
}

.message-time {
    font-size: 0.625rem;
    color: var(--grey-500);
    margin-top: 0.25rem;
    text-align: right;
}

.message.sent .message-time {
    color: rgba(255, 255, 255, 0.7);
}

.message-image {
    max-width: 200px;
    border-radius: var(--border-radius-sm);
    margin-bottom: 0.5rem;
    cursor: pointer;
    transition: var(--transition-fast);
}

.message-image.expanded {
    max-width: 400px;
    width: 100%;
}

.message-file {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 6px;
}

.file-icon {
    width: 32px;
    height: 32px;
    background: var(--primary-green);
    color: var(--pure-white);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-info {
    flex: 1;
}

.file-name {
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.file-size {
    font-size: 0.75rem;
    opacity: 0.7;
}

.file-download {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 4px;
    transition: var(--transition-fast);
}

.file-download:hover {
    background: rgba(255, 255, 255, 0.1);
}

.message-voice {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.voice-player {
    width: 100%;
    max-width: 300px;
    height: 40px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.1);
}

.voice-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: var(--grey-500);
}

.voice-duration {
    font-weight: 500;
}

/* Voice recording interface */
.voice-recording {
    padding: 1rem;
    background: var(--grey-50);
    border-top: 1px solid var(--grey-300);
}

.voice-controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.recording-indicator {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-green);
    font-weight: 500;
}

.pulse {
    width: 12px;
    height: 12px;
    background: #f44336;
    border-radius: 50%;
    animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(244, 67, 54, 0.7);
    }
    
    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(244, 67, 54, 0);
    }
    
    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(244, 67, 54, 0);
    }
}

.recording-time {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    color: var(--grey-700);
    background: var(--pure-white);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    border: 1px solid var(--grey-300);
}

.recording-actions {
    display: flex;
    gap: 0.5rem;
}

.recording-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.stop-btn {
    background: #f44336;
    color: var(--pure-white);
}

.stop-btn:hover {
    background: #d32f2f;
}

.recording-btn.send-btn {
    background: var(--primary-green);
    color: var(--pure-white);
}

.recording-btn.send-btn:hover {
    background: var(--primary-dark);
}

/* New messages indicator */
.new-messages-indicator {
    position: absolute;
    bottom: 80px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--primary-green);
    color: var(--pure-white);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: var(--transition-fast);
    z-index: 10;
    box-shadow: var(--shadow-md);
}

.new-messages-indicator:hover {
    background: var(--primary-dark);
    transform: translateX(-50%) translateY(-2px);
}

.new-messages-indicator i {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-3px);
    }
    60% {
        transform: translateY(-2px);
    }
}

.chat-input-container {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--grey-300);
    background: var(--pure-white);
}

.chat-input-wrapper {
    display: flex;
    align-items: flex-end;
    gap: 0.75rem;
    background: var(--grey-50);
    border-radius: var(--border-radius-sm);
    padding: 0.75rem;
}

.chat-input {
    flex: 1;
    border: none;
    background: transparent;
    resize: none;
    outline: none;
    font-family: inherit;
    font-size: 0.875rem;
    line-height: 1.4;
    max-height: 120px;
    min-height: 20px;
}

.chat-input::placeholder {
    color: var(--grey-500);
}

.chat-input-actions {
    display: flex;
    gap: 0.5rem;
}

.input-action-btn {
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    color: var(--grey-500);
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
}

.input-action-btn:hover {
    background: var(--grey-300);
    color: var(--grey-700);
}

.send-btn {
    background: var(--primary-green);
    color: var(--pure-white);
}

.send-btn:hover {
    background: var(--primary-dark);
}

/* Loading and notification styles */
.alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
}

.alert-error {
    background: #f44336;
    color: white;
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive design */
@media (max-width: 768px) {
    .chat-container {
        flex-direction: column;
        height: calc(100vh - var(--header-height));
        margin: 0;
        border-radius: 0;
    }
    
    .chat-sidebar {
        width: 100%;
        height: 40%;
        border-left: none;
        border-bottom: 1px solid var(--grey-300);
    }
    
    .chat-main {
        height: 60%;
    }
    
    .message {
        max-width: 85%;
    }
}
</style>

@endsection
