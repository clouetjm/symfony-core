<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

final class <?= $class_name."\n" ?>
{
     private $name;

     public function __construct(string $name)
     {
         $this->name = $name;
     }

<?php foreach ($methods as $method => $method_value): ?>
    public function <?= $method_value['name']; ?>(<?php foreach ($method_value['args'] as $method_value_key => $method_value_value): ?><?= $method_value_value['type']; ?> <?= $method_value_value['value']; ?><?php if (!($method_value_key === array_key_last($method_value['args']))): ?>, <?php endif; ?><?php endforeach; ?>): <?= $method_value['return_type_hint']; ?><?= "\n" ?>
    {
        return $this-><?= $method_value['name']; ?>(<?php foreach ($method_value['args'] as $method_value_key => $method_value_value): ?><?= $method_value_value['value']; ?><?php if (!($method_value_key === array_key_last($method_value['args']))): ?>, <?php endif; ?><?php endforeach; ?>);
    }
<?php endforeach; ?>
}