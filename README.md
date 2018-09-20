ViewsCounter Bundle
===========================

ViewsCounter increments views counts for document/entity.

## Setup the bundle

#### Step 1: Install ViewsCounterBundle

ViewsCounter bundle is installed using [Composer][1].

```bash
composer require gulaandrij/views-counter-bundle

```

Enable ViewsCounterBundle in your AppKernel:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = [
        // ...
        new Lavulator\ViewsCounterBundle\CengizhanViewsCounterBundle(),
    ];

    // ...
}

```

#### Step 2: Configure your entity

``` php
<?php

namespace YourBundle\YourEntity;

use Lavulator\ViewsCounterBundle\Model\VisitableInterface;
use Lavulator\ViewsCounterBundle\Traits\VisitableEntityTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Article implements VisitableInterface
{
    use VisitableEntityTrait;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

}
```
## Usage:

``` php
<?php

....
$this->get('views_counter.views_counter')->count($article);
....

```
**How to configure**

If you can query builder ( recommendation for cached entity )
```yml
# config.yml
....
lavulator_views_counter:
    use_query_builder: true
```

[1]: https://getcomposer.org/download/
