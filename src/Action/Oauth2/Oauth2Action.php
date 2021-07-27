<?php

namespace App\Action\Oauth2;

use App\Domain\User\Service\UserCreator;
use App\Responder\Responder;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use OAuth2\HttpFoundationBridge\Request as BridgeRequest;
use OAuth2\Server;

/**
 * Action.
 */
final class Oauth2Action
{
    private Responder $responder;

    /**
     * @var oAuth2server
     */
    private $oAuth2server;

    /**
     * The constructor.
     *
     * @param Responder $responder The responder
     * @param UserCreator $userCreator The service
     */
    public function __construct(Responder $responder, Server $server)
    {
        $this->responder = $responder;
        $this->oAuth2server = $server;
    }

    /**
     * Action.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     *
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyRequest = $httpFoundationFactory->createRequest($request);
        $bridgeRequest = BridgeRequest::createFromRequest($symfonyRequest);

        $this->oAuth2server->handleTokenRequest($bridgeRequest)->send();
        die;
    }
}
