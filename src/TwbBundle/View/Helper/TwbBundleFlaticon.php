<?php

namespace TwbBundle\View\Helper;

use InvalidArgumentException;
use Zend\Form\View\Helper\AbstractHelper;

class TwbBundleFlaticon extends AbstractHelper
{
    /**
     * @var string
     */
    private static $flaticonFormat = '<span %s></span>';

    /**
     * Invoke helper as functor, proxies to {@link render()}.
     * @param string $sFlaticon
     * @param array $aFlaticonAttributes : [optionnal]
     * @return string|TwbBundleFlaticon
     */
    public function __invoke($sFlaticon = null, array $aFlaticonAttributes = null)
    {
        if (!$sFlaticon) {
            return $this;
        }
        return $this->render($sFlaticon, $aFlaticonAttributes);
    }

    /**
     * Retrieve flaticon markup
     * @param string $sFlaticon
     * @param  array $aFlaticonAttributes : [optionnal]
     * @throws InvalidArgumentException
     * @return string
     */
    public function render($sFlaticon, array $aFlaticonAttributes = null)
    {
        if (!is_scalar($sFlaticon)) {
            throw new InvalidArgumentException('Flaticon expects a scalar value, "' . gettype($sFlaticon) . '" given');
        }

        if (empty($aFlaticonAttributes)) {
            $aFlaticonAttributes = array('class' => 'flaticon');
        } else {

            if (empty($aFlaticonAttributes['class'])) {
                $aFlaticonAttributes['class'] = 'flaticon';
            } elseif (!preg_match('/(\s|^)flaticon(\s|$)/', $aFlaticonAttributes['class'])) {
                $aFlaticonAttributes['class'] .= ' flaticon';
            }
        }

        if (strpos('flaticon-', $sFlaticon) !== 0) {
            $sFlaticon = 'flaticon-' . $sFlaticon;
        }

        if (!preg_match('/(\s|^)' . preg_quote($sFlaticon, '/') . '(\s|$)/', $aFlaticonAttributes['class'])) {
            $aFlaticonAttributes['class'] .= ' ' . $sFlaticon;
        }

        return sprintf(
            self::$flaticonFormat,
            $this->createAttributesString($aFlaticonAttributes)
        );
    }
}
