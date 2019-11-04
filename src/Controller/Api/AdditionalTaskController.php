<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Money\Transaction\Repository\TransactionRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class AdditionalTaskController extends AbstractController
{
    /**
     * @Route("/additional-task")
     */
    public function query(TransactionRepository $repository)
    {
        echo '<pre>';
        print_r($repository->getRefundLastWeek());
        echo '</pre>';
        exit;
    }
}