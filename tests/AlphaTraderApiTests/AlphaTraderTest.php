<?php

namespace Tests;

use Alphatrader\ApiBundle\Api\AlphaTrader;
use Alphatrader\ApiBundle\Model\Company;
use Doctrine\Common\Annotations\AnnotationReader;
use GuzzleHttp\Psr7\Response;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\SerializerBuilder;
use PHPUnit\Framework\TestCase;

class AlphaTraderTest extends TestCase
{
    /**
     * @var AlphaTrader
     */
    protected $alphatrader;

    protected $config = [
        'apiurl'   => 'http://example.com',
        'username' => 'demo',
        'password' => 'password',
        'authid'   => 'partnerid',
        'jwt'      => 'jwttoken'
    ];

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $session = $this->createMock('Symfony\Component\HttpFoundation\Session\Session');
        $this->alphatrader = new AlphaTrader($this->config, $session);
    }

    public function test_createClient()
    {
        self::assertInstanceOf(AlphaTrader::class, $this->alphatrader);
    }
    
    public function test_formatTimeStamp()
    {
        $timestamp = $this->invokeMethod($this->alphatrader, 'formatTimeStamp', array(new \DateTime()));
        $this->assertTrue(is_int($timestamp));
        $time = mt_rand(1262055681,1474823143);
        $timestamp = $this->invokeMethod($this->alphatrader, 'formatTimeStamp', array($time));
        $this->assertTrue(is_int($timestamp));
    }

    /**
     * @return Bankaccount
     */
    public function test_getBankAccount()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getBankAccount();
    }

    public function test_getCashTransferLogs()
    {
        $log[0]['senderBankAccount'] = "1e31b49c-7f05-4f1e-8cf8-347e435a1b62";
        $log[0]['receiverBankAccount'] = "819725d2-3e97-4a20-b0e8-15ee23e1085b";
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCashTransferLogs(new \DateTime(),new \DateTime(),$log[0]['senderBankAccount'],$log[0]['receiverBankAccount']);
    }

    /*public function test_generateCash()
    {
        $this->expectException(RuntimeException::class);
        $this->assertNull($this->alphatrader->generateCash(50000)->getMessagePrototype());
    }*/

    public function test_getChats()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getChats();
    }

    public function test_getChat()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getChat(1);
    }

    public function test_getCurrentUser()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCurrentUser();
    }

    public function test_getUsers()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getUsers();
    }

    public function test_getUsersByNamePart()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getUsersByNamePart('test');
    }

    public function test_getUserByUsername()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getUserByUsername('test');
    }

    public function test_getCompanies()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCompanies(true);
    }

    public function test_getCompany()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCompany('1');
    }

    public function test_getCompaniesByUserName()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCompaniesByUserName('demo');
    }

    public function test_getCompanyBySecurityAccountId()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCompanyBySecurityAccountId(1);
    }

    public function test_getCompanyBySecurityIdentifier()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCompanyBySecurityIdentifier(1);
    }

    public function test_getCompanyProfile()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCompanyProfile(1);
    }

    public function test_createCompany()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->createCompany('test',50000);
    }

    public function test_registerUser()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->registerUser('test','test@test.xyz','password');
    }

    /*public function test_getUserJwt()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getUserJwt('test','password');
    }*/

    public function test_getUserProfile()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getUserProfile('test');
    }

    public function test_getEvents()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getEvents(new \DateTime());
    }

    public function test_getEventsByRealms()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getEventsByRealms('test', new \DateTime());
    }

    public function test_getEventsByType()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getEventsByType('test','', new \DateTime());
    }

    public function test_getPortfolio()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getPortfolio(1);
    }

    public function test_getListing()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getListing(1);
    }

    public function test_getListingProfile()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getListingProfile(1);
    }

    public function test_getSecurityOrderLogs()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getSecurityOrderLogs(1, new \DateTime(), new \DateTime(),2,3);
    }

    public function test_createBond()
    {
        $this->expectException(RuntimeException::class);
        $company = new Company();
        $company->setId(1);
        $this->alphatrader->createBond($company, 1,1,1,new \DateTime());
    }

    public function test_repayBond()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->repayBond();
    }

    public function test_getBond()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getBond(1);
    }

    public function test_createSystemBond()
    {
        $this->expectException(RuntimeException::class);
        $company = new Company();
        $company->setId(1);
        $this->alphatrader->getBond(1);

        return $this->alphatrader->createSystemBond(
            $company,
            1
        );
    }

    public function test_repaySystemBond()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->repaySystemBond();
    }

    public function test_getSystemBond()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getSystemBond(1);
    }

    public function test_createBankingLicense()
    {
        $company = new Company();
        $company->setId(1);
        $this->expectException(RuntimeException::class);
        $this->alphatrader->createBankingLicense($company);
    }
    
    public function test_getBankingLicense()
    {
        $company = new Company();
        $company->setId(1);
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getBankingLicense($company);
    }

    public function test_getMainInterestRate()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getMainInterestRate();
    }

    public function test_getLatestMainInterestRate()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getLatestMainInterestRate();
    }

    public function test_getCentralBankReservesById()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getCentralBankReservesById(1);
    }

    public function test_setNotificationsasRead()
    {
        //$this->expectException(RuntimeException::class);
        $response = $this->alphatrader->setNotificationsasRead(1);
        $this->assertNull($response);
    }

    public function test_getNotifications()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getNotifications();
    }

    public function test_getUnreadNotifications()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getUnreadNotifications();
    }

    public function test_getOrder()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->getOrder(1);
    }

    public function test_createOrder()
    {
        $this->expectException(RuntimeException::class);
        $this->alphatrader->createOrder(1,1,1,1,1,1,1);
    }
    
    /**
     * @param $response
     *
     * @return ApiClient
     */
    public function getClient($response)
    {
        $apiclient = $this->createMock('Alphatrader\ApiBundle\Api\ApiClient');
        $apiclient->method('request')->will($this->returnValue(new Response(200, [], $response)));
        $serializer = SerializerBuilder::create();
        $serializer->setAnnotationReader(new AnnotationReader());
        $serializer->build();
        $apiclient->method('getSerializer')->will($this->returnValue($serializer));
        return $apiclient;
    }
    
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}