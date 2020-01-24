<?php

namespace WebDelivery\Presenters;

use WebDelivery\Transformers\CategoriaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CategoriaPresenter
 *
 * @package namespace WebDelivery\Presenters;
 */
class CategoriaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CategoriaTransformer();
    }
}
