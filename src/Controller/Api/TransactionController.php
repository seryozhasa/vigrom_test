<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Money\Transaction\UseCase\Transaction\Command;
use App\Model\Money\Transaction\UseCase\Transaction\Handler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\Money\Transaction\Entity\Transaction\Type;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class TransactionController extends AbstractController
{
    private $handler;

    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    /**
     * @Route("/api/transaction/credit/{walletId}/{currencyCode}/{amount}/{cause}")
     * @return Response
     */
    public function credit(int $walletId, string $currencyCode, float $amount, string $cause): Response
    {
        try {
            $command = new Command($walletId, $currencyCode, Type::CREDIT, $amount, $cause);
            $this->handler->handle($command);
            return $this->json(['success']);
        } catch (\Exception $exception) {
            return $this->json([
                'error' => [
                    'error_msg' => $exception->getMessage(),
                ]
            ], 500);
        }
    }

    /**
     * @Route("/api/transaction/debit/{walletId}/{currencyCode}/{amount}/{cause}")
     * @return Response
     */
    public function debit(int $walletId, string $currencyCode, float $amount, string $cause): Response
    {
        try {
            $command = new Command($walletId, $currencyCode, Type::DEBIT, $amount, $cause);
            $this->handler->handle($command);
            return $this->json(['success']);
        } catch (\Exception $exception) {
            return $this->json([
                'error' => [
                    'error_msg' => $exception->getMessage(),
                ]
            ], 500);
        }
    }
}