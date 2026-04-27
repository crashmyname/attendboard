<?php
use Bpjs\Core\App;
use Bpjs\Core\Cache;
use Bpjs\Core\FileCacheDriver;

$app = new App();

$app->singleton(Bpjs\Core\Kernel::class, function () use ($app) {
    return new Bpjs\Core\Kernel($app);
});

Cache::init(
    new FileCacheDriver(BPJS_BASE_PATH . '/storage/cache')
);

return $app;
