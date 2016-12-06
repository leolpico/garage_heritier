<?php

namespace NDP\DateFieldsBundle\Form\DataTransformer;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class YearDateTransformer implements DataTransformerInterface
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

    public function transform($yearDate)
    {
        if (isset($yearDate['day'])) {
            unset($yearDate['day']);
        }
        if (isset($yearDate['month'])) {
            unset($yearDate['month']);
        }
        return $yearDate;
    }

    public function reverseTransform($yearDate)
    {
        try {
            if (!isset($yearDate['year'])) {
                return null;
            }
            $lastMonthofYear = date('n', mktime(0, 0, 0, 12, 1, $yearDate['year']));
            $lastDayofMonth = date('t', mktime(0, 0, 0, $lastMonthofYear, 1, $yearDate['year']));
            $yearDate['month'] = $lastMonthofYear;
            $yearDate['day'] = $lastDayofMonth;
            return $yearDate;
        } catch (TransformationFailedException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}