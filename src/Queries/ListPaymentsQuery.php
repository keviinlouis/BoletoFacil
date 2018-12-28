<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-28
 * Time: 15:25
 */

namespace Louisk\BoletoFacil\Queries;


use Carbon\Carbon;
use Louisk\BoletoFacil\Interfaces\Arrayable;

class ListPaymentsQuery implements Arrayable
{
    private $beginDueDate;
    private $endDueDate;
    private $beginPaymentDate;
    private $endPaymentDate;
    private $beginPaymentConfirmation;
    private $endPaymentConfirmation;

    public function __construct()
    {
        $this->beginDueDate = Carbon::now()->format('d/m/Y');
    }

    /**
     * @param Carbon $beginDueDate
     * @return ListPaymentsQuery
     */
    public function setBeginDueDate(Carbon $beginDueDate)
    {
        $this->beginDueDate = $beginDueDate->format('d/m/Y');
        return $this;
    }

    /**
     * @param Carbon $endDueDate
     * @return ListPaymentsQuery
     */
    public function setEndDueDate(Carbon $endDueDate)
    {
        $this->endDueDate = $endDueDate->format('d/m/Y');
        return $this;
    }

    /**
     * @param Carbon $beginPaymentDate
     * @return ListPaymentsQuery
     */
    public function setBeginPaymentDate(Carbon $beginPaymentDate)
    {
        $this->beginPaymentDate = $beginPaymentDate->format('d/m/Y');
        return $this;
    }

    /**
     * @param Carbon $endPaymentDate
     * @return ListPaymentsQuery
     */
    public function setEndPaymentDate(Carbon $endPaymentDate)
    {
        $this->endPaymentDate = $endPaymentDate->format('d/m/Y');
        return $this;
    }

    /**
     * @param Carbon $beginPaymentConfirmation
     * @return ListPaymentsQuery
     */
    public function setBeginPaymentConfirmation(Carbon $beginPaymentConfirmation)
    {
        $this->beginPaymentConfirmation = $beginPaymentConfirmation->format('d/m/Y');
        return $this;
    }

    /**
     * @param Carbon $endPaymentConfirmation
     * @return ListPaymentsQuery
     */
    public function setEndPaymentConfirmation(Carbon $endPaymentConfirmation)
    {
        $this->endPaymentConfirmation = $endPaymentConfirmation->format('d/m/Y');
        return $this;
    }


    public function toArray(): array
    {
        return [
            'beginDueDate' => $this->beginDueDate,
            'endDueDate' => $this->endDueDate,
            'beginPaymentDate' => $this->beginPaymentDate,
            'endPaymentDate' => $this->endPaymentDate,
            'beginPaymentConfirmation' => $this->beginPaymentConfirmation,
            'endPaymentConfirmation' => $this->endPaymentConfirmation,
        ];
    }
}
