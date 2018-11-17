<?php

namespace Onlinecheckwriter\ZohoSubscription;

use Onlinecheckwriter\ZohoSubscription\API\Addon;
use Onlinecheckwriter\ZohoSubscription\API\Customer;
use Onlinecheckwriter\ZohoSubscription\API\HostedPage;
use Onlinecheckwriter\ZohoSubscription\API\Invoice;
use Onlinecheckwriter\ZohoSubscription\API\Plan;
use Onlinecheckwriter\ZohoSubscription\API\Subscription;
use GuzzleHttp\Client;

class ZohoSubscriptionClient
{
    protected $passThrough = [
        'subscription',
        'plan',
        'invoice',
        'customer',
        'addon',
        'hostedPage'
    ];
    protected $token;
    protected $organizationId;
    protected $Cache;
    protected $ttl;
    protected $Client;

    public function __construct($token, $organizationId, $Cache, $ttl = 7200)
    {
        $this->token          = $token;
        $this->organizationId = $organizationId;
        $this->Cache          = $Cache;
        $this->ttl            = $ttl;
        $this->Client         = new Client(['base_uri' => 'https://subscriptions.zoho.com/api/v1/', 'timeout' => 300]);
    }

    public function subscription()
    {
        return new Subscription($this->token, $this->organizationId, $this->Cache);
    }

    public function plan()
    {
        return new Plan($this->token, $this->organizationId, $this->Cache);
    }

    public function invoice()
    {
        return new Invoice($this->token, $this->organizationId, $this->Cache);
    }

    public function customer()
    {
        return new Customer($this->token, $this->organizationId, $this->Cache);
    }

    public function addon()
    {
        return new Addon($this->token, $this->organizationId, $this->Cache);
    }

    public function hostedPage()
    {
        return new HostedPage($this->token, $this->organizationId, $this->Cache);
    }
}
