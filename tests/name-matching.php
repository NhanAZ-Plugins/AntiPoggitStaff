<?php

declare(strict_types=1);

namespace pocketmine\plugin {
    class PluginBase {}
}

namespace pocketmine\event {
    interface Listener {}
}

namespace NhanAZ\AntiPoggitStaff\Tests {
    use NhanAZ\AntiPoggitStaff\Main;
    use ReflectionClass;
    use ReflectionMethod;
    use RuntimeException;

    require dirname(__DIR__) . '/src/NhanAZ/AntiPoggitStaff/Main.php';
    $plugin = (new ReflectionClass(Main::class))->newInstanceWithoutConstructor();
    $alias = new ReflectionMethod(Main::class, 'isJasonAlias');
    $amnestied = new ReflectionMethod(Main::class, 'isAmnestied');

    if (!$alias->invoke($plugin, 'senpaijason') || !$alias->invoke($plugin, 'SENPAIJASON')
        || $alias->invoke($plugin, 'UnrelatedPlayer')
        || !$amnestied->invoke($plugin, 'CelticTrinculo')
        || $amnestied->invoke($plugin, 'UnrelatedPlayer')) {
        throw new RuntimeException('Case-insensitive account matching failed');
    }
    echo "PASS: alias and amnesty name matching\n";
}
