<?php

namespace WebDelivery\Presenters;

use WebDelivery\Transformers\ProdutoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdutoPresenter
 *
 * @package namespace WebDelivery\Presenters;
 */
class ProdutoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdutoTransformer();
    }
}
