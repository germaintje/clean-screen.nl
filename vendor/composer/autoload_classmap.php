<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Mollie\\Api\\CompatibilityChecker' => $baseDir . '/src/CompatibilityChecker.php',
    'Mollie\\Api\\Endpoints\\ChargebackEndpoint' => $baseDir . '/src/Endpoints/ChargebackEndpoint.php',
    'Mollie\\Api\\Endpoints\\CollectionEndpointAbstract' => $baseDir . '/src/Endpoints/CollectionEndpointAbstract.php',
    'Mollie\\Api\\Endpoints\\CustomerEndpoint' => $baseDir . '/src/Endpoints/CustomerEndpoint.php',
    'Mollie\\Api\\Endpoints\\CustomerPaymentsEndpoint' => $baseDir . '/src/Endpoints/CustomerPaymentsEndpoint.php',
    'Mollie\\Api\\Endpoints\\EndpointAbstract' => $baseDir . '/src/Endpoints/EndpointAbstract.php',
    'Mollie\\Api\\Endpoints\\InvoiceEndpoint' => $baseDir . '/src/Endpoints/InvoiceEndpoint.php',
    'Mollie\\Api\\Endpoints\\MandateEndpoint' => $baseDir . '/src/Endpoints/MandateEndpoint.php',
    'Mollie\\Api\\Endpoints\\MethodEndpoint' => $baseDir . '/src/Endpoints/MethodEndpoint.php',
    'Mollie\\Api\\Endpoints\\OnboardingEndpoint' => $baseDir . '/src/Endpoints/OnboardingEndpoint.php',
    'Mollie\\Api\\Endpoints\\OrderEndpoint' => $baseDir . '/src/Endpoints/OrderEndpoint.php',
    'Mollie\\Api\\Endpoints\\OrderLineEndpoint' => $baseDir . '/src/Endpoints/OrderLineEndpoint.php',
    'Mollie\\Api\\Endpoints\\OrderPaymentEndpoint' => $baseDir . '/src/Endpoints/OrderPaymentEndpoint.php',
    'Mollie\\Api\\Endpoints\\OrderRefundEndpoint' => $baseDir . '/src/Endpoints/OrderRefundEndpoint.php',
    'Mollie\\Api\\Endpoints\\OrganizationEndpoint' => $baseDir . '/src/Endpoints/OrganizationEndpoint.php',
    'Mollie\\Api\\Endpoints\\PaymentCaptureEndpoint' => $baseDir . '/src/Endpoints/PaymentCaptureEndpoint.php',
    'Mollie\\Api\\Endpoints\\PaymentChargebackEndpoint' => $baseDir . '/src/Endpoints/PaymentChargebackEndpoint.php',
    'Mollie\\Api\\Endpoints\\PaymentEndpoint' => $baseDir . '/src/Endpoints/PaymentEndpoint.php',
    'Mollie\\Api\\Endpoints\\PaymentRefundEndpoint' => $baseDir . '/src/Endpoints/PaymentRefundEndpoint.php',
    'Mollie\\Api\\Endpoints\\PermissionEndpoint' => $baseDir . '/src/Endpoints/PermissionEndpoint.php',
    'Mollie\\Api\\Endpoints\\ProfileEndpoint' => $baseDir . '/src/Endpoints/ProfileEndpoint.php',
    'Mollie\\Api\\Endpoints\\ProfileMethodEndpoint' => $baseDir . '/src/Endpoints/ProfileMethodEndpoint.php',
    'Mollie\\Api\\Endpoints\\RefundEndpoint' => $baseDir . '/src/Endpoints/RefundEndpoint.php',
    'Mollie\\Api\\Endpoints\\SettlementPaymentEndpoint' => $baseDir . '/src/Endpoints/SettlementPaymentEndpoint.php',
    'Mollie\\Api\\Endpoints\\SettlementsEndpoint' => $baseDir . '/src/Endpoints/SettlementsEndpoint.php',
    'Mollie\\Api\\Endpoints\\ShipmentEndpoint' => $baseDir . '/src/Endpoints/ShipmentEndpoint.php',
    'Mollie\\Api\\Endpoints\\SubscriptionEndpoint' => $baseDir . '/src/Endpoints/SubscriptionEndpoint.php',
    'Mollie\\Api\\Endpoints\\WalletEndpoint' => $baseDir . '/src/Endpoints/WalletEndpoint.php',
    'Mollie\\Api\\Exceptions\\ApiException' => $baseDir . '/src/Exceptions/ApiException.php',
    'Mollie\\Api\\Exceptions\\IncompatiblePlatform' => $baseDir . '/src/Exceptions/IncompatiblePlatform.php',
    'Mollie\\Api\\Guzzle\\RetryMiddlewareFactory' => $baseDir . '/src/Guzzle/RetryMiddlewareFactory.php',
    'Mollie\\Api\\MollieApiClient' => $baseDir . '/src/MollieApiClient.php',
    'Mollie\\Api\\Resources\\BaseCollection' => $baseDir . '/src/Resources/BaseCollection.php',
    'Mollie\\Api\\Resources\\BaseResource' => $baseDir . '/src/Resources/BaseResource.php',
    'Mollie\\Api\\Resources\\Capture' => $baseDir . '/src/Resources/Capture.php',
    'Mollie\\Api\\Resources\\CaptureCollection' => $baseDir . '/src/Resources/CaptureCollection.php',
    'Mollie\\Api\\Resources\\Chargeback' => $baseDir . '/src/Resources/Chargeback.php',
    'Mollie\\Api\\Resources\\ChargebackCollection' => $baseDir . '/src/Resources/ChargebackCollection.php',
    'Mollie\\Api\\Resources\\CurrentProfile' => $baseDir . '/src/Resources/CurrentProfile.php',
    'Mollie\\Api\\Resources\\CursorCollection' => $baseDir . '/src/Resources/CursorCollection.php',
    'Mollie\\Api\\Resources\\Customer' => $baseDir . '/src/Resources/Customer.php',
    'Mollie\\Api\\Resources\\CustomerCollection' => $baseDir . '/src/Resources/CustomerCollection.php',
    'Mollie\\Api\\Resources\\Invoice' => $baseDir . '/src/Resources/Invoice.php',
    'Mollie\\Api\\Resources\\InvoiceCollection' => $baseDir . '/src/Resources/InvoiceCollection.php',
    'Mollie\\Api\\Resources\\Issuer' => $baseDir . '/src/Resources/Issuer.php',
    'Mollie\\Api\\Resources\\IssuerCollection' => $baseDir . '/src/Resources/IssuerCollection.php',
    'Mollie\\Api\\Resources\\Mandate' => $baseDir . '/src/Resources/Mandate.php',
    'Mollie\\Api\\Resources\\MandateCollection' => $baseDir . '/src/Resources/MandateCollection.php',
    'Mollie\\Api\\Resources\\Method' => $baseDir . '/src/Resources/Method.php',
    'Mollie\\Api\\Resources\\MethodCollection' => $baseDir . '/src/Resources/MethodCollection.php',
    'Mollie\\Api\\Resources\\MethodPrice' => $baseDir . '/src/Resources/MethodPrice.php',
    'Mollie\\Api\\Resources\\MethodPriceCollection' => $baseDir . '/src/Resources/MethodPriceCollection.php',
    'Mollie\\Api\\Resources\\Onboarding' => $baseDir . '/src/Resources/Onboarding.php',
    'Mollie\\Api\\Resources\\Order' => $baseDir . '/src/Resources/Order.php',
    'Mollie\\Api\\Resources\\OrderCollection' => $baseDir . '/src/Resources/OrderCollection.php',
    'Mollie\\Api\\Resources\\OrderLine' => $baseDir . '/src/Resources/OrderLine.php',
    'Mollie\\Api\\Resources\\OrderLineCollection' => $baseDir . '/src/Resources/OrderLineCollection.php',
    'Mollie\\Api\\Resources\\Organization' => $baseDir . '/src/Resources/Organization.php',
    'Mollie\\Api\\Resources\\OrganizationCollection' => $baseDir . '/src/Resources/OrganizationCollection.php',
    'Mollie\\Api\\Resources\\Payment' => $baseDir . '/src/Resources/Payment.php',
    'Mollie\\Api\\Resources\\PaymentCollection' => $baseDir . '/src/Resources/PaymentCollection.php',
    'Mollie\\Api\\Resources\\Permission' => $baseDir . '/src/Resources/Permission.php',
    'Mollie\\Api\\Resources\\PermissionCollection' => $baseDir . '/src/Resources/PermissionCollection.php',
    'Mollie\\Api\\Resources\\Profile' => $baseDir . '/src/Resources/Profile.php',
    'Mollie\\Api\\Resources\\ProfileCollection' => $baseDir . '/src/Resources/ProfileCollection.php',
    'Mollie\\Api\\Resources\\Refund' => $baseDir . '/src/Resources/Refund.php',
    'Mollie\\Api\\Resources\\RefundCollection' => $baseDir . '/src/Resources/RefundCollection.php',
    'Mollie\\Api\\Resources\\ResourceFactory' => $baseDir . '/src/Resources/ResourceFactory.php',
    'Mollie\\Api\\Resources\\Settlement' => $baseDir . '/src/Resources/Settlement.php',
    'Mollie\\Api\\Resources\\SettlementCollection' => $baseDir . '/src/Resources/SettlementCollection.php',
    'Mollie\\Api\\Resources\\Shipment' => $baseDir . '/src/Resources/Shipment.php',
    'Mollie\\Api\\Resources\\ShipmentCollection' => $baseDir . '/src/Resources/ShipmentCollection.php',
    'Mollie\\Api\\Resources\\Subscription' => $baseDir . '/src/Resources/Subscription.php',
    'Mollie\\Api\\Resources\\SubscriptionCollection' => $baseDir . '/src/Resources/SubscriptionCollection.php',
    'Mollie\\Api\\Types\\InvoiceStatus' => $baseDir . '/src/Types/InvoiceStatus.php',
    'Mollie\\Api\\Types\\MandateMethod' => $baseDir . '/src/Types/MandateMethod.php',
    'Mollie\\Api\\Types\\MandateStatus' => $baseDir . '/src/Types/MandateStatus.php',
    'Mollie\\Api\\Types\\OnboardingStatus' => $baseDir . '/src/Types/OnboardingStatus.php',
    'Mollie\\Api\\Types\\OrderLineStatus' => $baseDir . '/src/Types/OrderLineStatus.php',
    'Mollie\\Api\\Types\\OrderLineType' => $baseDir . '/src/Types/OrderLineType.php',
    'Mollie\\Api\\Types\\OrderStatus' => $baseDir . '/src/Types/OrderStatus.php',
    'Mollie\\Api\\Types\\PaymentMethod' => $baseDir . '/src/Types/PaymentMethod.php',
    'Mollie\\Api\\Types\\PaymentMethodStatus' => $baseDir . '/src/Types/PaymentMethodStatus.php',
    'Mollie\\Api\\Types\\PaymentStatus' => $baseDir . '/src/Types/PaymentStatus.php',
    'Mollie\\Api\\Types\\ProfileStatus' => $baseDir . '/src/Types/ProfileStatus.php',
    'Mollie\\Api\\Types\\RefundStatus' => $baseDir . '/src/Types/RefundStatus.php',
    'Mollie\\Api\\Types\\SequenceType' => $baseDir . '/src/Types/SequenceType.php',
    'Mollie\\Api\\Types\\SettlementStatus' => $baseDir . '/src/Types/SettlementStatus.php',
    'Mollie\\Api\\Types\\SubscriptionStatus' => $baseDir . '/src/Types/SubscriptionStatus.php',
    '_PhpScoper5f8847d7a6e47\\ArithmeticError' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/ArithmeticError.php',
    '_PhpScoper5f8847d7a6e47\\AssertionError' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/AssertionError.php',
    '_PhpScoper5f8847d7a6e47\\Composer\\CaBundle\\CaBundle' => $vendorDir . '/composer/ca-bundle/src/CaBundle.php',
    '_PhpScoper5f8847d7a6e47\\DivisionByZeroError' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/DivisionByZeroError.php',
    '_PhpScoper5f8847d7a6e47\\Error' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/Error.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Client' => $vendorDir . '/guzzlehttp/guzzle/src/Client.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\ClientInterface' => $vendorDir . '/guzzlehttp/guzzle/src/ClientInterface.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Cookie\\CookieJar' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/CookieJar.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Cookie\\CookieJarInterface' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/CookieJarInterface.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Cookie\\FileCookieJar' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/FileCookieJar.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Cookie\\SessionCookieJar' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/SessionCookieJar.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Cookie\\SetCookie' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/SetCookie.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\BadResponseException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/BadResponseException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\ClientException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/ClientException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\ConnectException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/ConnectException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\GuzzleException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/GuzzleException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\InvalidArgumentException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/InvalidArgumentException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\RequestException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/RequestException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\SeekException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/SeekException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\ServerException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/ServerException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\TooManyRedirectsException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/TooManyRedirectsException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Exception\\TransferException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/TransferException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\HandlerStack' => $vendorDir . '/guzzlehttp/guzzle/src/HandlerStack.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\CurlFactory' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlFactory.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\CurlFactoryInterface' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlFactoryInterface.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\CurlHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlHandler.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\CurlMultiHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\EasyHandle' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/EasyHandle.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\MockHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/MockHandler.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\Proxy' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/Proxy.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Handler\\StreamHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/StreamHandler.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\MessageFormatter' => $vendorDir . '/guzzlehttp/guzzle/src/MessageFormatter.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Middleware' => $vendorDir . '/guzzlehttp/guzzle/src/Middleware.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Pool' => $vendorDir . '/guzzlehttp/guzzle/src/Pool.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\PrepareBodyMiddleware' => $vendorDir . '/guzzlehttp/guzzle/src/PrepareBodyMiddleware.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\AggregateException' => $vendorDir . '/guzzlehttp/promises/src/AggregateException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\CancellationException' => $vendorDir . '/guzzlehttp/promises/src/CancellationException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\Coroutine' => $vendorDir . '/guzzlehttp/promises/src/Coroutine.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\Create' => $vendorDir . '/guzzlehttp/promises/src/Create.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\Each' => $vendorDir . '/guzzlehttp/promises/src/Each.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\EachPromise' => $vendorDir . '/guzzlehttp/promises/src/EachPromise.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\FulfilledPromise' => $vendorDir . '/guzzlehttp/promises/src/FulfilledPromise.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\Is' => $vendorDir . '/guzzlehttp/promises/src/Is.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\Promise' => $vendorDir . '/guzzlehttp/promises/src/Promise.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\PromiseInterface' => $vendorDir . '/guzzlehttp/promises/src/PromiseInterface.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\PromisorInterface' => $vendorDir . '/guzzlehttp/promises/src/PromisorInterface.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\RejectedPromise' => $vendorDir . '/guzzlehttp/promises/src/RejectedPromise.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\RejectionException' => $vendorDir . '/guzzlehttp/promises/src/RejectionException.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\TaskQueue' => $vendorDir . '/guzzlehttp/promises/src/TaskQueue.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\TaskQueueInterface' => $vendorDir . '/guzzlehttp/promises/src/TaskQueueInterface.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Promise\\Utils' => $vendorDir . '/guzzlehttp/promises/src/Utils.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\AppendStream' => $vendorDir . '/guzzlehttp/psr7/src/AppendStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\BufferStream' => $vendorDir . '/guzzlehttp/psr7/src/BufferStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\CachingStream' => $vendorDir . '/guzzlehttp/psr7/src/CachingStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\DroppingStream' => $vendorDir . '/guzzlehttp/psr7/src/DroppingStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\FnStream' => $vendorDir . '/guzzlehttp/psr7/src/FnStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Header' => $vendorDir . '/guzzlehttp/psr7/src/Header.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\InflateStream' => $vendorDir . '/guzzlehttp/psr7/src/InflateStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\LazyOpenStream' => $vendorDir . '/guzzlehttp/psr7/src/LazyOpenStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\LimitStream' => $vendorDir . '/guzzlehttp/psr7/src/LimitStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Message' => $vendorDir . '/guzzlehttp/psr7/src/Message.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\MessageTrait' => $vendorDir . '/guzzlehttp/psr7/src/MessageTrait.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\MimeType' => $vendorDir . '/guzzlehttp/psr7/src/MimeType.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\MultipartStream' => $vendorDir . '/guzzlehttp/psr7/src/MultipartStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\NoSeekStream' => $vendorDir . '/guzzlehttp/psr7/src/NoSeekStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\PumpStream' => $vendorDir . '/guzzlehttp/psr7/src/PumpStream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Query' => $vendorDir . '/guzzlehttp/psr7/src/Query.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Request' => $vendorDir . '/guzzlehttp/psr7/src/Request.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Response' => $vendorDir . '/guzzlehttp/psr7/src/Response.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Rfc7230' => $vendorDir . '/guzzlehttp/psr7/src/Rfc7230.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\ServerRequest' => $vendorDir . '/guzzlehttp/psr7/src/ServerRequest.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Stream' => $vendorDir . '/guzzlehttp/psr7/src/Stream.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\StreamDecoratorTrait' => $vendorDir . '/guzzlehttp/psr7/src/StreamDecoratorTrait.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\StreamWrapper' => $vendorDir . '/guzzlehttp/psr7/src/StreamWrapper.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\UploadedFile' => $vendorDir . '/guzzlehttp/psr7/src/UploadedFile.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Uri' => $vendorDir . '/guzzlehttp/psr7/src/Uri.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\UriNormalizer' => $vendorDir . '/guzzlehttp/psr7/src/UriNormalizer.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\UriResolver' => $vendorDir . '/guzzlehttp/psr7/src/UriResolver.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Psr7\\Utils' => $vendorDir . '/guzzlehttp/psr7/src/Utils.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\RedirectMiddleware' => $vendorDir . '/guzzlehttp/guzzle/src/RedirectMiddleware.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\RequestOptions' => $vendorDir . '/guzzlehttp/guzzle/src/RequestOptions.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\RetryMiddleware' => $vendorDir . '/guzzlehttp/guzzle/src/RetryMiddleware.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\TransferStats' => $vendorDir . '/guzzlehttp/guzzle/src/TransferStats.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\UriTemplate' => $vendorDir . '/guzzlehttp/guzzle/src/UriTemplate.php',
    '_PhpScoper5f8847d7a6e47\\GuzzleHttp\\Utils' => $vendorDir . '/guzzlehttp/guzzle/src/Utils.php',
    '_PhpScoper5f8847d7a6e47\\Normalizer' => $vendorDir . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
    '_PhpScoper5f8847d7a6e47\\ParseError' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/ParseError.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\MessageInterface' => $vendorDir . '/psr/http-message/src/MessageInterface.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\RequestInterface' => $vendorDir . '/psr/http-message/src/RequestInterface.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\ResponseInterface' => $vendorDir . '/psr/http-message/src/ResponseInterface.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\ServerRequestInterface' => $vendorDir . '/psr/http-message/src/ServerRequestInterface.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\StreamInterface' => $vendorDir . '/psr/http-message/src/StreamInterface.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\UploadedFileInterface' => $vendorDir . '/psr/http-message/src/UploadedFileInterface.php',
    '_PhpScoper5f8847d7a6e47\\Psr\\Http\\Message\\UriInterface' => $vendorDir . '/psr/http-message/src/UriInterface.php',
    '_PhpScoper5f8847d7a6e47\\SessionUpdateTimestampHandlerInterface' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/SessionUpdateTimestampHandlerInterface.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Intl\\Idn\\Idn' => $vendorDir . '/symfony/polyfill-intl-idn/Idn.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Intl\\Idn\\Info' => $vendorDir . '/symfony/polyfill-intl-idn/Info.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\DisallowedRanges' => $vendorDir . '/symfony/polyfill-intl-idn/Resources/unidata/DisallowedRanges.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\Regex' => $vendorDir . '/symfony/polyfill-intl-idn/Resources/unidata/Regex.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Intl\\Normalizer\\Normalizer' => $vendorDir . '/symfony/polyfill-intl-normalizer/Normalizer.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Php70\\Php70' => $vendorDir . '/symfony/polyfill-php70/Php70.php',
    '_PhpScoper5f8847d7a6e47\\Symfony\\Polyfill\\Php72\\Php72' => $vendorDir . '/symfony/polyfill-php72/Php72.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\API\\Exceptions\\ApiExceptionTest' => $baseDir . '/tests/Mollie/API/Exceptions/ApiExceptionTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\API\\Resources\\MandateCollectionTest' => $baseDir . '/tests/Mollie/API/Resources/MandateCollectionTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\API\\Resources\\OnboardingTest' => $baseDir . '/tests/Mollie/API/Resources/OnboardingTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\API\\Types\\MandateMethodTest' => $baseDir . '/tests/Mollie/API/Types/MandateMethodTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\CompatibilityCheckerTest' => $baseDir . '/tests/Mollie/API/CompatibilityCheckerTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\BaseEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/BaseEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\ChargebackEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/ChargebackEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\CustomerEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/CustomerEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\CustomerPaymentEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/CustomerPaymentEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\CustomerSubscriptionPaymentEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/CustomerSubscriptionPaymentEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\InvoiceEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/InvoiceEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\MandateEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/MandateEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\MethodEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/MethodEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\OnboardingEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/OnboardingEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\OrderEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/OrderEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\OrderLineEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/OrderLineEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\OrderPaymentEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/OrderPaymentEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\OrderRefundEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/OrderRefundEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\OrganizationEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/OrganizationEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\PaymentCaptureEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/PaymentCaptureEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\PaymentChargebackEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/PaymentChargebackEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\PaymentEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/PaymentEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\PaymentRefundEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/PaymentRefundEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\PermissionEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/PermissionEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\ProfileEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/ProfileEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\ProfileMethodEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/ProfileMethodEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\RefundEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/RefundEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\SettlementEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/SettlementEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\SettlementPaymentsEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/SettlementPaymentsEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\ShipmentEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/ShipmentEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\SubscriptionEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/SubscriptionEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Endpoints\\WalletEndpointTest' => $baseDir . '/tests/Mollie/API/Endpoints/WalletEndpointTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\MollieApiClientTest' => $baseDir . '/tests/Mollie/API/MollieApiClientTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\InvoiceTest' => $baseDir . '/tests/Mollie/API/Resources/InvoiceTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\MethodTest' => $baseDir . '/tests/Mollie/API/Resources/MethodTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\OrderLineCollectionTest' => $baseDir . '/tests/Mollie/API/Resources/OrderLineCollectionTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\OrderLineTest' => $baseDir . '/tests/Mollie/API/Resources/OrderLineTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\OrderTest' => $baseDir . '/tests/Mollie/API/Resources/OrderTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\PaymentTest' => $baseDir . '/tests/Mollie/API/Resources/PaymentTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\ProfileTest' => $baseDir . '/tests/Mollie/API/Resources/ProfileTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\RefundTest' => $baseDir . '/tests/Mollie/API/Resources/RefundTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\ResourceFactoryTest' => $baseDir . '/tests/Mollie/API/Resources/ResourceFactoryTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\SettlementTest' => $baseDir . '/tests/Mollie/API/Resources/SettlementTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\ShipmentTest' => $baseDir . '/tests/Mollie/API/Resources/ShipmentTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Api\\Resources\\SubscriptionTest' => $baseDir . '/tests/Mollie/API/Resources/SubscriptionTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\Guzzle\\RetryMiddlewareFactoryTest' => $baseDir . '/tests/Mollie/Guzzle/RetryMiddlewareFactoryTest.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\TestHelpers\\AmountObjectTestHelpers' => $baseDir . '/tests/Mollie/TestHelpers/AmountObjectTestHelpers.php',
    '_PhpScoper5f8847d7a6e47\\Tests\\Mollie\\TestHelpers\\LinkObjectTestHelpers' => $baseDir . '/tests/Mollie/TestHelpers/LinkObjectTestHelpers.php',
    '_PhpScoper5f8847d7a6e47\\TypeError' => $vendorDir . '/symfony/polyfill-php70/Resources/stubs/TypeError.php',
);
