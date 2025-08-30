@extends('dashboard.index')

@section('title', 'تعديل الشركة')

@section('content')
<div class="container mx-auto">
    <div class="data-table">
        <div class="table-header">
            <h3 class="table-title">
                <i class="fas fa-building"></i>
                تعديل الشركة: {{ $company->name }}
            </h3>
            <div class="table-actions">
                <a href="{{ route('admin.companies.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-right"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>

        <div class="table-content">
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.companies.update', $company) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- اسم الشركة -->
                        <div class="form-group">
                            <label for="name" class="form-label">اسم الشركة</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $company->name) }}" 
                                   class="form-input @error('name') border-red-500 @enderror" 
                                   placeholder="أدخل اسم الشركة" required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- نوع الشركة -->
                        <div class="form-group">
                            <label for="type" class="form-label">نوع الشركة</label>
                            <select id="type" name="type" class="form-input @error('type') border-red-500 @enderror" required>
                                <option value="">اختر نوع الشركة</option>
                                <option value="technology" {{ old('type', $company->type) == 'technology' ? 'selected' : '' }}>تقنية</option>
                                <option value="finance" {{ old('type', $company->type) == 'finance' ? 'selected' : '' }}>مالية</option>
                                <option value="healthcare" {{ old('type', $company->type) == 'healthcare' ? 'selected' : '' }}>رعاية صحية</option>
                                <option value="education" {{ old('type', $company->type) == 'education' ? 'selected' : '' }}>تعليم</option>
                                <option value="retail" {{ old('type', $company->type) == 'retail' ? 'selected' : '' }}>بيع بالتجزئة</option>
                                <option value="manufacturing" {{ old('type', $company->type) == 'manufacturing' ? 'selected' : '' }}>تصنيع</option>
                                <option value="other" {{ old('type', $company->type) == 'other' ? 'selected' : '' }}>أخرى</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="form-group">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $company->email) }}" 
                                   class="form-input @error('email') border-red-500 @enderror" 
                                   placeholder="أدخل البريد الإلكتروني" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- رقم الهاتف -->
                        <div class="form-group">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $company->phone) }}" 
                                   class="form-input @error('phone') border-red-500 @enderror" 
                                   placeholder="أدخل رقم الهاتف" required>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- الموقع الإلكتروني -->
                        <div class="form-group">
                            <label for="website" class="form-label">الموقع الإلكتروني</label>
                            <input type="url" id="website" name="website" value="{{ old('website', $company->website ?? '') }}" 
                                   class="form-input @error('website') border-red-500 @enderror" 
                                   placeholder="https://example.com">
                            @error('website')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- عدد الموظفين -->
                        <div class="form-group">
                            <label for="employee_count" class="form-label">عدد الموظفين</label>
                            <select id="employee_count" name="employee_count" class="form-input @error('employee_count') border-red-500 @enderror">
                                <option value="">اختر عدد الموظفين</option>
                                <option value="1-10" {{ old('employee_count', $company->employee_count) == '1-10' ? 'selected' : '' }}>1-10</option>
                                <option value="11-50" {{ old('employee_count', $company->employee_count) == '11-50' ? 'selected' : '' }}>11-50</option>
                                <option value="51-200" {{ old('employee_count', $company->employee_count) == '51-200' ? 'selected' : '' }}>51-200</option>
                                <option value="201-500" {{ old('employee_count', $company->employee_count) == '201-500' ? 'selected' : '' }}>201-500</option>
                                <option value="500+" {{ old('employee_count', $company->employee_count) == '500+' ? 'selected' : '' }}>500+</option>
                            </select>
                            @error('employee_count')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- العنوان -->
                    <div class="form-group">
                        <label for="address" class="form-label">العنوان</label>
                        <textarea id="address" name="address" rows="3" 
                                  class="form-input @error('address') border-red-500 @enderror" 
                                  placeholder="أدخل العنوان الكامل للشركة">{{ old('address', $company->address ?? '') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- وصف الشركة -->
                    <div class="form-group">
                        <label for="description" class="form-label">وصف الشركة</label>
                        <textarea id="description" name="description" rows="5" 
                                  class="form-input @error('description') border-red-500 @enderror" 
                                  placeholder="أدخل وصفاً مختصراً عن الشركة ونشاطها">{{ old('description', $company->description ?? '') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- شعار الشركة -->
                    <div class="form-group">
                        <label for="logo" class="form-label">شعار الشركة</label>
                        
                        @if($company->logo)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">الشعار الحالي:</p>
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="شعار الشركة" 
                                 class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                        </div>
                        @endif
                        
                        <input type="file" id="logo" name="logo" 
                               class="form-input @error('logo') border-red-500 @enderror" 
                               accept="image/*">
                        <p class="text-sm text-gray-500 mt-1">اتركه فارغاً إذا لم ترد تغيير الشعار. يُفضل أن يكون الشعار بحجم 200x200 بكسل</p>
                        @error('logo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- الحالة -->
                    <div class="form-group">
                        <label class="form-label">حالة الشركة</label>
                        <div class="flex items-center space-x-6 space-x-reverse">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="active" 
                                       {{ old('status', $company->status ?? 'active') == 'active' ? 'checked' : '' }} 
                                       class="mr-2 text-primary-green">
                                <span>مفعلة</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="pending" 
                                       {{ old('status', $company->status ?? 'active') == 'pending' ? 'checked' : '' }} 
                                       class="mr-2 text-primary-green">
                                <span>قيد المراجعة</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="inactive" 
                                       {{ old('status', $company->status ?? 'active') == 'inactive' ? 'checked' : '' }} 
                                       class="mr-2 text-primary-green">
                                <span>معطلة</span>
                            </label>
                        </div>
                    </div>

                    <!-- معلومات إضافية -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-700 mb-3">معلومات إضافية</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">تاريخ الإنشاء:</span>
                                <span class="text-sm font-medium">{{ $company->created_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">آخر تحديث:</span>
                                <span class="text-sm font-medium">{{ $company->updated_at->format('Y-m-d H:i') }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">معرف الشركة:</span>
                                <span class="text-sm font-medium font-mono">{{ $company->id }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- أزرار الإجراءات -->
                    <div class="flex justify-end space-x-4 space-x-reverse pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline">
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

.text-gray-600 {
    color: #4b5563;
}

.font-medium {
    font-weight: 500;
}

.font-mono {
    font-family: ui-monospace, SFMono-Regular, "SF Mono", Consolas, "Liberation Mono", Menlo, monospace;
}

.mb-4 {
    margin-bottom: 1rem;
}

.mb-2 {
    margin-bottom: 0.5rem;
}

.w-20 {
    width: 5rem;
}

.h-20 {
    height: 5rem;
}

.object-cover {
    object-fit: cover;
}

.border {
    border-width: 1px;
}

.border-gray-200 {
    border-color: #e5e7eb;
}
</style>
@endsection
