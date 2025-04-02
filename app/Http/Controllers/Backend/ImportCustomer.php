<?php

namespace App\Imports;

use App\Model\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class ImportCustomer implements ToModel, WithHeadingRow, SkipsOnError, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \App\Model\Customer|null
     */
    public function model(array $row)
    {
        return new Customer([
            'ct_code' => $row['ma_khach_hang'] ?? null, // Tên cột trong Excel
            'ct_name' => $row['ten_khach_hang'] ?? null, // Tên cột trong Excel
            // Bạn có thể thêm các trường khác của model Customer ở đây
            // Ví dụ:
            // 'ct_email' => $row['email'] ?? null,
            // 'ct_phone' => $row['so_dien_thoai'] ?? null,
            // 'ct_address' => $row['dia_chi'] ?? null,
        ]);
    }

    /**
     * @return int
     */
    public function headingRow(): int
    {
        return 1; // Dòng đầu tiên chứa tiêu đề cột
    }

    /**
     * @param Throwable $e
     */
    public function onError(Throwable $e)
    {
        \Log::error("Lỗi import hàng: " . $e->getMessage());
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'ma_khach_hang' => 'required|unique:customers,ct_code',
            'ten_khach_hang' => 'required|max:255',
            // Thêm các quy tắc validation cho các cột khác
            // Ví dụ:
            // 'email' => 'nullable|email|max:255|unique:customers,ct_email',
            // 'so_dien_thoai' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
    }

    /**
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'ma_khach_hang.required' => 'Mã khách hàng là bắt buộc.',
            'ma_khach_hang.unique' => 'Mã khách hàng này đã tồn tại.',
            'ten_khach_hang.required' => 'Tên khách hàng là bắt buộc.',
            'ten_khach_hang.max' => 'Tên khách hàng không được quá 255 ký tự.',
            // Thêm thông báo lỗi tùy chỉnh cho các quy tắc khác
        ];
    }
}