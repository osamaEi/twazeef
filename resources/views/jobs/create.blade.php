@extends('dashboard.index')

@section('title', 'إنشاء وظيفة جديدة')

@section('content')

        
            <div class="content-header">
                <h1>إنشاء وظيفة جديدة</h1>
                <p>أضف وظيفة جديدة لشركتك</p>
            </div>

            <div class="form-container">
                <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="job-form">
                    @csrf
                    
                    <div class="form-section">
                        <h3>معلومات الوظيفة الأساسية</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="title">عنوان الوظيفة *</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="form-control">
                                @error('title')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="location">الموقع *</label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}" required class="form-control" placeholder="مثال: الرياض، المملكة العربية السعودية">
                                @error('location')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="type">نوع الوظيفة *</label>
                                <select id="type" name="type" required class="form-control">
                                    <option value="">اختر نوع الوظيفة</option>
                                    <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>دوام كامل</option>
                                    <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>دوام جزئي</option>
                                    <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>عقد مؤقت</option>
                                    <option value="freelance" {{ old('type') == 'freelance' ? 'selected' : '' }}>عمل حر</option>
                                </select>
                                @error('type')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="experience_level">مستوى الخبرة *</label>
                                <select id="experience_level" name="experience_level" required class="form-control">
                                    <option value="">اختر مستوى الخبرة</option>
                                    <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>مبتدئ (0-2 سنة)</option>
                                    <option value="mid" {{ old('experience_level') == 'mid' ? 'selected' : '' }}>متوسط (3-5 سنة)</option>
                                    <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>متقدم (6-10 سنة)</option>
                                    <option value="executive" {{ old('experience_level') == 'executive' ? 'selected' : '' }}>خبير (أكثر من 10 سنوات)</option>
                                </select>
                                @error('experience_level')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="salary_min">الراتب الأدنى</label>
                                <input type="number" id="salary_min" name="salary_min" value="{{ old('salary_min') }}" class="form-control" placeholder="0" min="0" step="0.01">
                                @error('salary_min')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="salary_max">الراتب الأعلى</label>
                                <input type="number" id="salary_max" name="salary_max" value="{{ old('salary_max') }}" class="form-control" placeholder="0" min="0" step="0.01">
                                @error('salary_max')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="salary_currency">عملة الراتب *</label>
                            <select id="salary_currency" name="salary_currency" required class="form-control">
                                <option value="">اختر العملة</option>
                                <option value="SAR" {{ old('salary_currency') == 'SAR' ? 'selected' : '' }}>ريال سعودي (SAR)</option>
                                <option value="USD" {{ old('salary_currency') == 'USD' ? 'selected' : '' }}>دولار أمريكي (USD)</option>
                                <option value="EUR" {{ old('salary_currency') == 'EUR' ? 'selected' : '' }}>يورو (EUR)</option>
                                <option value="AED" {{ old('salary_currency') == 'AED' ? 'selected' : '' }}>درهم إماراتي (AED)</option>
                                <option value="KWD" {{ old('salary_currency') == 'KWD' ? 'selected' : '' }}>دينار كويتي (KWD)</option>
                            </select>
                            @error('salary_currency')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>تفاصيل الوظيفة</h3>
                        
                        <div class="form-group">
                            <label for="image">صورة الوظيفة</label>
                            <div class="image-upload-container">
                                <div class="image-preview" id="imagePreview">
                                    <i class="fas fa-image"></i>
                                    <span>اضغط لاختيار صورة</span>
                                </div>
                                <input type="file" id="image" name="image" accept="image/*" class="image-input" onchange="previewImage(this)">
                                <div class="image-info">
                                    <small class="form-help">يُسمح بملفات الصور: JPG, PNG, GIF, WebP. الحد الأقصى: 2MB</small>
                                </div>
                            </div>
                            @error('image')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">وصف الوظيفة *</label>
                            <textarea id="description" name="description" rows="8" required class="form-control" placeholder="اكتب وصفاً مفصلاً للوظيفة والمتطلبات...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="skills">المهارات المطلوبة</label>
                            <div class="skills-input-container">
                                <div class="skills-tags" id="skills-tags"></div>
                                <input type="text" id="skills-input" class="form-control" placeholder="اكتب مهارة واضغط Enter">
                                <div id="skills-fields"></div>
                            </div>
                            <small class="form-help">اضغط Enter لإضافة كل مهارة</small>
                            @error('skills')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="benefits">المزايا والعوائد</label>
                            <div class="benefits-input-container">
                                <div class="benefits-tags" id="benefits-tags"></div>
                                <input type="text" id="benefits-input" class="form-control" placeholder="اكتب ميزة واضغط Enter">
                                <div id="benefits-fields"></div>
                            </div>
                            <small class="form-help">اضغط Enter لإضافة كل ميزة</small>
                            @error('benefits')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>معلومات إضافية</h3>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="status">حالة الوظيفة</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>نشطة</option>
                                    <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>معلقة</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                                </select>
                                @error('status')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="expires_at">تاريخ انتهاء الصلاحية</label>
                                <input type="date" id="expires_at" name="expires_at" value="{{ old('expires_at') }}" class="form-control">
                                <small class="form-help">اتركه فارغاً إذا كنت تريد أن تكون الوظيفة دائمة</small>
                                @error('expires_at')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            إنشاء الوظيفة
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="saveAsDraft()">
                            <i class="fas fa-file-alt"></i>
                            حفظ كمسودة
                        </button>
                        <a href="{{ route('jobs.index') }}" class="btn btn-outline">
                            <i class="fas fa-arrow-right"></i>
                            إلغاء
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Skills and Benefits management
let skills = [];
let benefits = [];

function addSkill(skill) {
    if (skill.trim() && !skills.includes(skill.trim())) {
        skills.push(skill.trim());
        updateSkillsDisplay();
        updateSkillsInput();
        
        // Visual feedback
        const input = document.getElementById('skills-input');
        input.style.borderColor = '#10b981';
        input.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        
        setTimeout(() => {
            input.style.borderColor = '#e1e5e9';
            input.style.boxShadow = 'none';
        }, 1000);
        
        // Show success message
        showMessage('تم إضافة المهارة بنجاح', 'success');
    } else if (skills.includes(skill.trim())) {
        showMessage('هذه المهارة موجودة بالفعل', 'warning');
    }
}

function removeSkill(index) {
    const removedSkill = skills[index];
    skills.splice(index, 1);
    updateSkillsDisplay();
    updateSkillsInput();
    
    // Show removal message
    showMessage(`تم إزالة المهارة: ${removedSkill}`, 'info');
}

function addBenefit(benefit) {
    if (benefit.trim() && !benefits.includes(benefit.trim())) {
        benefits.push(benefit.trim());
        updateBenefitsDisplay();
        updateBenefitsInput();
        
        // Visual feedback
        const input = document.getElementById('benefits-input');
        input.style.borderColor = '#10b981';
        input.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
        
        setTimeout(() => {
            input.style.borderColor = '#e1e5e9';
            input.style.boxShadow = 'none';
        }, 1000);
        
        // Show success message
        showMessage('تم إضافة الميزة بنجاح', 'success');
    } else if (benefits.includes(benefit.trim())) {
        showMessage('هذه الميزة موجودة بالفعل', 'warning');
    }
}

function removeBenefit(index) {
    const removedBenefit = benefits[index];
    benefits.splice(index, 1);
    updateBenefitsDisplay();
    updateBenefitsInput();
    
    // Show removal message
    showMessage(`تم إزالة الميزة: ${removedBenefit}`, 'info');
}

// Message display function
function showMessage(message, type = 'info') {
    // Remove existing message
    const existingMessage = document.querySelector('.message-toast');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Create message element
    const messageEl = document.createElement('div');
    messageEl.className = `message-toast message-${type}`;
    messageEl.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Add to page
    document.body.appendChild(messageEl);
    
    // Show message
    setTimeout(() => {
        messageEl.classList.add('show');
    }, 100);
    
    // Hide message after 3 seconds
    setTimeout(() => {
        messageEl.classList.remove('show');
        setTimeout(() => {
            messageEl.remove();
        }, 300);
    }, 3000);
}

function updateSkillsDisplay() {
    const container = document.getElementById('skills-tags');
    container.innerHTML = skills.map((skill, index) => 
        `<span class="tag">${skill} <button type="button" onclick="removeSkill(${index})" class="tag-remove">&times;</button></span>`
    ).join('');
}

function updateBenefitsDisplay() {
    const container = document.getElementById('benefits-tags');
    container.innerHTML = benefits.map((benefit, index) => 
        `<span class="tag">${benefit} <button type="button" onclick="removeBenefit(${index})" class="tag-remove">&times;</button></span>`
    ).join('');
}

function updateSkillsInput() {
    const container = document.getElementById('skills-fields');
    container.innerHTML = '';
    
    skills.forEach((skill, index) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'skills[]';
        input.value = skill;
        container.appendChild(input);
    });
}

function updateBenefitsInput() {
    const container = document.getElementById('benefits-fields');
    container.innerHTML = '';
    
    benefits.forEach((benefit, index) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'benefits[]';
        input.value = benefit;
        container.appendChild(input);
    });
}

// Initialize skills and benefits from old input if exists
document.addEventListener('DOMContentLoaded', function() {
    // Check if there are old input values from validation errors
    @if(old('skills'))
        skills = @json(old('skills'));
        updateSkillsDisplay();
        updateSkillsInput();
    @endif
    
    @if(old('benefits'))
        benefits = @json(old('benefits'));
        updateBenefitsDisplay();
        updateBenefitsInput();
    @endif
    
    // Initialize empty arrays if no old values
    if (skills.length === 0) {
        updateSkillsInput();
    }
    if (benefits.length === 0) {
        updateBenefitsInput();
    }
});

// Event listeners for skills input
document.getElementById('skills-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addSkill(this.value);
        this.value = '';
    }
});

// Event listeners for benefits input
document.getElementById('benefits-input').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addBenefit(this.value);
        this.value = '';
    }
});

function saveAsDraft() {
    document.getElementById('status').value = 'draft';
    document.querySelector('.job-form').submit();
}

// Auto-save functionality
let autoSaveTimer;
const form = document.querySelector('.job-form');

form.addEventListener('input', function() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(function() {
        // Auto-save as draft
        const currentStatus = document.getElementById('status').value;
        if (currentStatus !== 'draft') {
            document.getElementById('status').value = 'draft';
        }
        
        // You can implement actual auto-save here
        console.log('Auto-saving as draft...');
    }, 30000); // Auto-save after 30 seconds of inactivity
});

// Image preview functionality
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const file = input.files[0];
    
    if (file) {
        // Validate file size (2MB = 2 * 1024 * 1024 bytes)
        if (file.size > 2 * 1024 * 1024) {
            alert('حجم الصورة يجب أن يكون أقل من 2MB');
            input.value = '';
            return;
        }
        
        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            alert('نوع الملف غير مسموح به. يرجى اختيار صورة بصيغة JPG, PNG, GIF, أو WebP');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" alt="معاينة الصورة" class="preview-image">
                <button type="button" class="remove-image" onclick="removeImage()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            preview.classList.add('has-image');
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    const preview = document.getElementById('imagePreview');
    const input = document.getElementById('image');
    
    preview.innerHTML = `
        <i class="fas fa-image"></i>
        <span>اضغط لاختيار صورة</span>
    `;
    preview.classList.remove('has-image');
    input.value = '';
}

// Form validation
form.addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    const type = document.getElementById('type').value;
    const experienceLevel = document.getElementById('experience_level').value;
    const salaryCurrency = document.getElementById('salary_currency').value;
    
    if (!title || !description || !type || !experienceLevel || !salaryCurrency) {
        e.preventDefault();
        alert('يرجى ملء جميع الحقول المطلوبة');
        return false;
    }
    
    // Validate salary range
    const salaryMin = parseFloat(document.getElementById('salary_min').value) || 0;
    const salaryMax = parseFloat(document.getElementById('salary_max').value) || 0;
    
    if (salaryMax > 0 && salaryMin > salaryMax) {
        e.preventDefault();
        alert('الراتب الأدنى لا يمكن أن يكون أكبر من الراتب الأعلى');
        return false;
    }
    
    // Ensure skills and benefits arrays are properly set before submission
    updateSkillsInput();
    updateBenefitsInput();
    
    // Debug: Log what's being sent
    console.log('Skills being sent:', skills);
    console.log('Benefits being sent:', benefits);
    
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإنشاء...';
    submitBtn.disabled = true;
});
</script>

<style>
.form-container {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-top: 1rem;
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #eee;
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.form-section h3 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    font-size: 1.2rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-color);
}

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control.error {
    border-color: #ef4444;
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.form-help {
    color: #6b7280;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

/* Image Upload Styles */
.image-upload-container {
    position: relative;
}

.image-preview {
    width: 100%;
    height: 200px;
    border: 2px dashed #e1e5e9;
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f9fafb;
    position: relative;
    overflow: hidden;
}

.image-preview:hover {
    border-color: var(--primary-color);
    background: #f0f9ff;
}

.image-preview.has-image {
    border-style: solid;
    border-color: var(--primary-color);
}

.image-preview i {
    font-size: 3rem;
    color: #9ca3af;
    margin-bottom: 1rem;
}

.image-preview span {
    color: #6b7280;
    font-size: 1rem;
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.remove-image {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.875rem;
}

.remove-image:hover {
    background: #ef4444;
    transform: scale(1.1);
}

.image-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.image-info {
    margin-top: 0.5rem;
    text-align: center;
}

/* Skills and Benefits Tags */
.skills-input-container,
.benefits-input-container {
    position: relative;
}

.skills-tags,
.benefits-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    min-height: 2.5rem;
    padding: 0.5rem;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    background: #f9fafb;
    transition: border-color 0.3s ease;
}

.skills-tags:focus-within,
.benefits-tags:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.tag {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.875rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
    transition: all 0.3s ease;
    animation: tagAppear 0.3s ease-out;
}

.tag:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(59, 82, 246, 0.4);
}

.tag-remove {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    cursor: pointer;
    font-size: 1rem;
    line-height: 1;
    padding: 0;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
    margin-right: -0.25rem;
}

.tag-remove:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
}

/* Animation for tags appearing */
@keyframes tagAppear {
    from {
        opacity: 0;
        transform: scale(0.8) translateY(10px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Empty state styling */
.skills-tags:empty::before,
.benefits-tags:empty::before {
    content: "لا توجد مهارات مضافة";
    color: #9ca3af;
    font-style: italic;
    font-size: 0.875rem;
}

.skills-tags:empty::before {
    content: "لا توجد مهارات مضافة";
}

.benefits-tags:empty::before {
    content: "لا توجد مزايا مضافة";
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-start;
    align-items: center;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
}

.btn-secondary {
    background: #6b7280;
    color: white;
}

.btn-secondary:hover {
    background: #4b5563;
}

.btn-outline {
    background: transparent;
    color: var(--text-color);
    border: 2px solid #e1e5e9;
}

.btn-outline:hover {
    background: #f9fafb;
    border-color: var(--primary-color);
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn {
        justify-content: center;
    }
}
</style>
@endsection
