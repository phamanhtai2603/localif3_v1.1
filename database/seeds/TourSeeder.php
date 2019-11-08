<?php

use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tour')->insert([
            'tourguide_id'=>2,    //2
            'location_id'=>1,    //Từ 1(Hội An),2(Đà Nẵng),3(Huế)
            'name'=>'Tour vòng quanh Hội An',    //Nếu phía trên là 1 thì ở dưới tour phải tên là Hội An, 2 thì là Đà Nẵng,... 
            'description'=>'Là một phố cổ nhỏ nằm tại tỉnh Quảng Nam. Hằng năm có hàng triệu lượt du khách.... chém 3 4 dòng',
            'content'=>'Tour du lịch này được tạo ra nhằm chia sẽ lối sống của người bản địa cho du khách, thưởng thức món ăn....', //Đây là nội dung bài đăng, Càng dài càng tốt. Giới thiệu về tour
            'plan'=>'Sáng 8h: Xuất phát &nbsp; Trưa 12h:Ăn&nbsp; Tối:...',// Đây là lịch
            'price'=>'1200000', // giá tùy chọn
            'img'=>'1.png,2.png,3.png,4.png', //Hình ảnh cứ giữ nguyên như này, thay đổi thứ tự cũng dc
            'avgrate'=>'4', //Cho từ 1 tới 5
            //Lưu ý, dấu  &nbsp; dùng để xuống dòng, enter ko có tác dụng vì lưu trong database
        ]);
        DB::table('tour')->insert([
            'tourguide_id'=>2,    //2 luôn điền 2
            'location_id'=>2,    //Từ 1(Hội An),2(Đà Nẵng),3(Huế)
            'name'=>'Tour vòng quanh Đà Nẵng',    //Nếu phía trên là 1 thì ở dưới tour phải tên là Hội An, 2 thì là Đà Nẵng,... 
            'description'=>'Là một phố trẻ. Hằng năm có hàng triệu lượt du khách.... chém 3 4 dòng',
            'content'=>'Tour du lịch này được tạo ra nhằm chia sẽ lối sống của người bản địa cho du khách, thưởng thức món ăn....', //Đây là nội dung bài đăng, Càng dài càng tốt. Giới thiệu về tour
            'plan'=>'Sáng 8h: Xuất phát &nbsp; Trưa 12h:Ăn &nbsp; Tối:...',// Đây là lịch
            'price'=>'1200000', // giá tùy chọn
            'img'=>'1.png,2.png,3.png,4.png', //Hình ảnh cứ giữ nguyên như này, thay đổi thứ tự cũng dc
            'avgrate'=>'4', //Cho từ 1 tới 5
            //Lưu ý, dấu  &nbsp; dùng để xuống dòng, enter ko có tác dụng vì lưu trong database
        ]);
        
    }
}
