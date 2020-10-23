<?php

namespace Tests\Unit\Domain\Product;

use App\Domain\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_should_only_accept_price_as_positive_integer(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectDeprecationMessage('The price should be a positive integer');
        new Money('BRL', -120);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_accept_brl_and_usd_as_currency(): void
    {
        $brl = new Money('BRL', 4200);
        $this->assertEquals('BRL', $brl->currency());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_accept_usd_as_currency(): void
    {
        $usd = new Money('USD', 4200);
        $this->assertEquals('USD', $usd->currency());
    }

    /**
     * @test
     * @return void
     */
    public function it_should_throw_an_exception_if_currency_not_supported(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectDeprecationMessage('Currency not supported');
        new Money('RANDOM', 4200);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_formatted_string_representation_of_currency(): void
    {
        $brl = (new Money('BRL', 4200000000))->toString();
        $brlWithCents = (new Money('BRL', 4200000002))->toString();

        $usd = (new Money('USD', 420000000))->toString();
        $usdWithCents = (new Money('USD', 420000002))->toString();

        $this->assertIsString($brl);
        $this->assertEquals('42.000.000,00', $brl);
        $this->assertEquals('42.000.000,02', $brlWithCents);

        $this->assertIsString($usd);
        $this->assertEquals('4,200,000.00', $usd);
        $this->assertEquals('4,200,000.02', $usdWithCents);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_decimal_representation_of_price(): void
    {
        $noCents = (new Money('BRL', 4200000000))->toDecimal();
        $withCents = (new Money('BRL', 4200000002))->toDecimal();

        $this->assertIsFloat($noCents);
        $this->assertIsFloat($withCents);
        $this->assertEquals(42000000.00, $noCents);
        $this->assertEquals(42000000.02, $withCents);
    }

    /**
     * @test
     * @return void
     */
    public function it_should_return_a_array_representation(): void
    {
        $price = 4200000000;
        $noCents = (new Money('BRL', $price))->toArray();
        $this->assertIsArray($noCents);
        $this->assertArrayHasKey('price', $noCents);
        $this->assertArrayHasKey('currency', $noCents);
        $this->assertEquals($noCents['price'], $price);
        $this->assertEquals($noCents['currency'], 'BRL');
    }
}
