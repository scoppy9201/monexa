<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthPagesTest extends TestCase
{
    public function test_login_page_uses_the_vietnamese_url(): void
    {
        $this->get('/dang-nhap?lang=vi')
            ->assertOk()
            ->assertSeeText('Đăng nhập tài khoản')
            ->assertSee('name="email"', false)
            ->assertSee('name="password"', false);
    }

    public function test_register_page_uses_the_vietnamese_url(): void
    {
        $this->get('/dang-ky?lang=vi')
            ->assertOk()
            ->assertSeeText('Tạo tài khoản')
            ->assertSee('name="email"', false)
            ->assertSee('name="terms"', false);
    }

    public function test_legacy_english_auth_urls_are_not_registered(): void
    {
        $this->get('/login')->assertNotFound();
        $this->get('/register')->assertNotFound();
    }
}
