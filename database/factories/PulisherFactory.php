<?php

namespace Database\Factories;

use App\Models\Pulisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publisher>
 */
class PulisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pulisher::class;
    public function definition(): array
    {
        $publisherNames = [
            'Penguin Random House',
            'Hachette Livre',
            'HarperCollins',
            'Macmillan Publishers',
            'Simon & Schuster',
            'Pearson',
            'Springer Nature',
            'Scholastic',
            'Cengage Learning',
            'Wiley',
            'McGraw-Hill Education',
            'Houghton Mifflin Harcourt',
            'John Wiley & Sons',
            'Oxford University Press',
            'Nhà xuất bản Trẻ',
            'Nhà xuất bản Kim Đồng',
            'Nhà xuất bản Giáo dục Việt Nam',
            'Nhà xuất bản Văn học',
            'Nhà xuất bản Hội Nhà văn',
            'Nhà xuất bản Phụ nữ Việt Nam',
            'Nhà xuất bản Tổng hợp TP.HCM',
            'Nhà xuất bản Lao động',
            'Nhà xuất bản Thế giới',
            'Nhà xuất bản Văn hóa - Văn nghệ',
            'Nhà xuất bản Chính trị quốc gia Sự thật',
            'Nhà xuất bản Khoa học và Kỹ thuật',
            'Nhà xuất bản Thông tin và Truyền thông',
            'Nhà xuất bản Từ điển Bách khoa',
            'Nhà xuất bản Đại học Quốc gia Hà Nội',
            'Nhà xuất bản Đại học Sư phạm',
        ];
        return [
            //
            'name' => $this->faker->unique()->randomElement($publisherNames),
        ];
    }
}
