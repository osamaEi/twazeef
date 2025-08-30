@extends('dashboard.index')

@section('title', 'تعديل المستخدم')

@section('content')
<div class="container mx-auto">
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-user-edit"></i>
                تعديل المستخدم: {{ $user->name }}
            </h3>
            <div class="table-actions">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>

        <div class="table-content">
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- الاسم -->
                        <div class="form-group">
                            <label for="name" class="form-label">الاسم الكامل</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                   class="form-input @error('name') border-red-500 @enderror" 
                                   placeholder="أدخل الاسم الكامل" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="form-group">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="form-input @error('email') border-red-500 @enderror" 
                                   placeholder="أدخل البريد الإلكتروني" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- كلمة المرور الجديدة (اختيارية) -->
                        <div class="form-group">
                            <label for="password" class="form-label">كلمة المرور الجديدة (اختيارية)</label>
                            <input type="password" id="password" name="password" 
                                   class="form-input @error('password') border-red-500 @enderror" 
                                   placeholder="اتركها فارغة إذا لم ترد تغييرها">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- تأكيد كلمة المرور -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-input" 
                                   placeholder="أعد إدخال كلمة المرور الجديدة">
                        </div>

                        <!-- الدور -->
                        <div class="form-group">
                            <label for="role" class="form-label">الدور</label>
                            <select id="role" name="role" class="form-input @error('role') border-red-500 @enderror" required>
                                <option value="">اختر الدور</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مدير النظام</option>
                                <option value="company" {{ old('role', $user->role) == 'company' ? 'selected' : '' }}>جهة عمل</option>
                                <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>باحث عن عمل</option>
                            </select>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="form-group">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                                   class="form-input @error('phone') border-red-500 @enderror" 
                                   placeholder="أدخل رقم الهاتف">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- العنوان -->
                    <div class="form-group">
                        <label for="address" class="form-label">العنوان</label>
                        <textarea id="address" name="address" rows="3" 
                                  class="form-input @error('address') border-red-500 @enderror" 
                                  placeholder="أدخل العنوان">{{ old('address', $user->address ?? '') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الحالة -->
                    <div class="form-group">
                        <label class="form-label">الحالة</label>
                        <div class="flex items-center space-x-6 space-x-reverse">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="active" 
                                       {{ old('status', $user->status ?? 'active') == 'active' ? 'checked' : '' }} 
                                       class="mr-2 text-primary-green">
                                <span>مفعل</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="inactive" 
                                       {{ old('status', $user->status ?? 'active') == 'inactive' ? 'checked' : '' }} 
                                       class="mr-2 text-primary-green">
                                <span>معطل</span>
                            </label>
                        </div>
                    </div>

                    <!-- معلومات إضافية -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-700 mb-3">معلومات إضافية</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">تاريخ الإنشاء:</span>
                                <span class="text-sm font-medium">{{ $user->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">آخر تحديث:</span>
                                <span class="text-sm font-medium">{{ $user->updated_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">تأكيد البريد:</span>
                                <span class="text-sm font-medium {{ $user->email_verified_at ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $user->email_verified_at ? 'مؤكد' : 'غير مؤكد' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- أزرار الإجراءات -->
                    <div class="flex justify-end space-x-4 space-x-reverse pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline">
                            <i class="fas fa-times"></i>
                            إلغاء
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--grey-700);
    font-weight: 600;
    font-size: 0.9rem;
}

.form-input {
    width: 100%;
    padding: 1rem;
    border: 2px solid var(--grey-300);
    border-radius: var(--border-radius-sm);
    font-family: var(--font-main);
    font-size: 1rem;
    transition: var(--transition-fast);
    background: var(--pure-white);
}

.form-input:focus {
    outline: none;
    border-color: var(--primary-green);
    box-shadow: 0 0 0 3px rgba(0, 109, 70, 0.1);
}

.form-input.border-red-500 {
    border-color: #ef4444;
}

.text-red-500 {
    color: #ef4444;
}

.space-y-6 > * + * {
    margin-top: 1.5rem;
}

.grid {
    display: grid;
}

.grid-cols-1 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

@media (min-width: 768px) {
    .md\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

.gap-6 {
    gap: 1.5rem;
}

.gap-4 {
    gap: 1rem;
}

.space-x-4 > * + * {
    margin-right: 1rem;
}

.space-x-reverse > * + * {
    margin-right: 1rem;
}

.pt-6 {
    padding-top: 1.5rem;
}

.border-t {
    border-top-width: 1px;
}

.border-gray-200 {
    border-color: #e5e7eb;
}

.flex {
    display: flex;
}

.justify-end {
    justify-content: flex-end;
}

.items-center {
    align-items: center;
}

.space-x-6 > * + * {
    margin-right: 1.5rem;
}

.space-x-reverse > * + * {
    margin-right: 1.5rem;
}

.mr-2 {
    margin-right: 0.5rem;
}

.text-primary-green {
    color: var(--primary-green);
}

.bg-gray-50 {
    background-color: #f9fafb;
}

.p-4 {
    padding: 1rem;
}

.rounded-lg {
    border-radius: 0.5rem;
}

.font-semibold {
    font-weight: 600;
}

.text-gray-700 {
    color: #374151;
}

.mb-3 {
    margin-bottom: 0.75rem;
}

.text-sm {
    font-size: 0.875rem;
}

.text-gray-500 {
    color: #6b7280;
}

.font-medium {
    font-weight: 500;
}

.text-green-600 {
    color: #059669;
}

.text-red-600 {
    color: #dc2626;
}
</style>
@endsection
