<?php

namespace WebDelivery\Presenters;

use WebDelivery\Transformers\EmpresaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EmpresaPresenter
 *
 * @package namespace WebDelivery\Presenters;
 */
class EmpresaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EmpresaTransformer();
    }
}
