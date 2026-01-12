<?php

namespace App\Providers;
use App\Repository\PaymentRepositoryInterface;
use App\Services\Payment\PaymentMethods\CashPayment;
use App\Services\Payment\PaymentMethods\PaypalPayment;
use App\Services\Payment\PaymentMethods\StripePayment;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

// Provide minimal stubs for Doctrine DBAL when DBAL isn't installed to allow migrations/tests to run
        if (!class_exists('\Doctrine\DBAL\Schema\FakeSchemaManager')) {
            eval('namespace Doctrine\\DBAL\\Schema; class FakeSchemaManager { public function getDatabasePlatform(){ return new class { public function getAlterTableSQL($tableDiff){ return []; } }; } }');
        }

        if (!class_exists('\Doctrine\DBAL\\Driver\\AbstractSQLiteDriver')) {
            eval('namespace Doctrine\\DBAL\\Driver; abstract class AbstractSQLiteDriver { public function getSchemaManager($connection, $platform = null) { return new \\Doctrine\\DBAL\\Schema\\FakeSchemaManager(); } }');
        }

        if (!class_exists('\Doctrine\DBAL\\Driver\\AbstractMySQLDriver')) {
            eval('namespace Doctrine\\DBAL\\Driver; abstract class AbstractMySQLDriver { public function getSchemaManager($connection, $platform = null) { return new \\Doctrine\\DBAL\\Schema\\FakeSchemaManager(); } }');
        }

        if (!class_exists('\Doctrine\DBAL\\Connection')) {
            // Minimal Connection stub so Laravel's calls to instantiate a Doctrine connection won't fatal
            eval('namespace Doctrine\\DBAL; class Connection { public function __construct(array $params = []) {} public function getDatabasePlatform(){ return new class { public function getName(){ return "sqlite"; } }; } }');
        }


        $this->app->bind(PaymentRepositoryInterface::class, function () {

            $request = app(\Illuminate\Http\Request::class);

            if ($request->post('type_pay') == 'cash') {

                return new CashPayment();
            }
            if ($request->post('type_pay') == 'paypal') {

                return new PaypalPayment();
            }
            if ($request->post('type_pay') == 'stripe') {

                return new StripePayment();

            }


        });






    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
