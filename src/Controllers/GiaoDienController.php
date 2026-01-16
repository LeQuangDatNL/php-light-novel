<?php

namespace App\Controllers;
use App\Controller;

class GiaoDienController extends Controller
{
    public function TrangChu()
    {
        $this->renderNoData('GiaoDienUser\Trangchu');
    }
     public function TrangChuAdmin()
    {
        $this->renderNoData('GiaoDienAdmin\Trangchu');
    }
    public function Profile()
    {
        $this->renderNoData('GiaoDienUser\ThongTinTaiKhoan');
    }
}