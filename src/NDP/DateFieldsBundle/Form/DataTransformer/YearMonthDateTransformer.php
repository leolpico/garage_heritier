<?php

namespace NDP\DateFieldsBundle\Form\DataTransformer;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class YearMonthDateTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function transform($yearmonthDate)
    {
        if (isset($yearmonthDate['day'])) {
            unset($yearmonthDate['day']);
        }
        return $yearmonthDate;
    }

    public function reverseTransform($yearmonthDate)
    {
        try {
            if (!isset($yearmonthDate['month']) || !isset($yearmonthDate['year'])) {
                return null;
            }
            $lastDayofMonth = date('t', mktime(0, 0, 0, $yearmonthDate['month'], 1, $yearmonthDate['year']));
            $yearmonthDate['day'] = $lastDayofMonth;
            return $yearmonthDate;
        } catch (TransformationFailedException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}