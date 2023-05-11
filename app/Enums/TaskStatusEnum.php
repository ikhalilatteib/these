<?php

namespace App\Enums;

enum TaskStatusEnum:int
{
    case PENDING = 0;
    
    case SUCCESS = 1;
    
    case FAILED = 2;
    
    public function taskStatusButton(): string
    {
        return match ($this){
            self::PENDING => '<button class="btn btn-secondary-rgba btn-sm"><i class="ri-time-line"></i></button>',
            self::SUCCESS => '<button class="btn btn-success-rgba btn-sm"><i class="ri-checkbox-circle-line"></i></button>',
            self::FAILED => '<button class="btn btn-danger-rgba btn-sm"><i class="ri-close-circle-line"></i></button>'
        };
    }
    
    public function taskStatusBadge(): string
    {
        return match ($this){
            self::PENDING => '<span class="text-black">Beklemede <i class="ri-time-line text-info"></i></span>',
            self::SUCCESS => '<span class="text-black">Başarılı <i class="ri-checkbox-circle-line text-success"></i></span>',
            self::FAILED => '<span class="text-black">Başarısız <i class="ri-close-circle-line text-danger"></i></span>'
        };
    }
}
