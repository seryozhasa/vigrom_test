<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Money\Wallet\Entity\Wallet\Wallet;
use App\Model\Money\Wallet\Repository\WalletRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 *
 * @author sergey seryozhasafonov@gmail.com
 */
class BalanceController extends AbstractController
{
    /**
     * @Route("/api/balance/{walletId}")
     * @return Response
     */
    public function balance(int $walletId, WalletRepository $repository): Response
    {
        try {
            $wallet = $repository->get($walletId);
            return $this->json([
                'response' => [
                    'balance' => $wallet->getBalance(),
                    'currency' => $wallet->getCurrency()->getCode(),
                ],
            ]);
        } catch (\Exception $exception) {
            return $this->json(['error' => $exception->getMessage()], 404);
        }
    }
}