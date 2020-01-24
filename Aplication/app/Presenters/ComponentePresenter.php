<?php

namespace WebDelivery\Presenters;

use WebDelivery\Transformers\ComponenteTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ComponentePresenter
 *
 * @package namespace WebDelivery\Presenters;
 */
class ComponentePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ComponenteTransformer();
    }
}
