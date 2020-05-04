@extends('hanoivip::layouts.app-id')

@section('content')
    <div class="zid_pagecont"> 
        <h2 class="content_title"><span class="titlebullet zidsprt"></span>Thông tin chung</h2>       
        <div class="formrow">
            <label class="formrow_label"><span>Họ tên:</span></label>
            <div class="formrow_content" style="overflow:hidden; word-wrap: break-word;">
                @if (!empty($personal->hoten))
                        {{ $personal->hoten }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
            <a href="{{ route('personal-update') }}" alt='cap nhat' class="formrow_editbtn">Cập nhật</a>
        </div>
        <div class="formrow" id="gender">
            <label class="formrow_label"><span>Giới tính:</span></label>        
            <div class="formrow_content">
                @if (!empty($personal->sex))
                    {{ $personal->sex }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
        </div> 
        <div class="formrow">
            <label class="formrow_label"><span>Ngày sinh:</span></label>
            <div class="formrow_content">
                @if (!empty($personal->birthday))
                    {{ $personal->birthday }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
        </div>
        <div class="formrow">
            <label class="formrow_label"><span>Địa chỉ:</span></label>
            <div style="overflow:hidden; word-wrap: break-word;" class="formrow_content">
                @if (!empty($personal->address))
                    {{ $personal->address }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
        </div>
        <div class="formrow">
            <label class="formrow_label"><span> Tỉnh/Thành phố:</span></label>
            <div class="formrow_content">
                @if (!empty($personal->address))
                    {{ $personal->address }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
        </div>
        <div class="formrow">
            <label class="formrow_label"><span>Nghề nghiệp:</span></label>
            <div class="formrow_content">
                @if (!empty($personal->career))
                    {{ $personal->career }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
        </div>
        <div class="formrow">
            <label class="formrow_label"><span>Tình trạng hôn nhân:</span></label>
            <div class="formrow_content">
                @if (!empty($personal->mariage))
                    {{ $personal->mariage }}
                @else
                        (Chưa thiết lập)
                @endif
            </div>
        </div>
    </div>
<script type="text/javascript">
    $=jQuery;
    jQuery(document).ready(function ($) {
        $('#menu_left2 a').addClass("selected");
    });
</script>
@endsection
