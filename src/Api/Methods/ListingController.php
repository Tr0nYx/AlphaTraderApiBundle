<?php

/*
 * This file is part of the AlphaTraderApiBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Alphatrader\ApiBundle\Api\Methods;

use Alphatrader\ApiBundle\Api\ApiClient;
use Alphatrader\ApiBundle\Model\Error;
use Alphatrader\ApiBundle\Model\Listing;
use Alphatrader\ApiBundle\Model\ListingProfile;
use Alphatrader\ApiBundle\Model\Shareholder;

/**
 * Class ListingController
 * @package AlphaTrader\API\Controller
 * @author Tr0nYx <tronyx@bric.finance>
 */
class ListingController extends ApiClient
{

    /**
     * @param $securityIdentifier
     *
     * @return ListingProfile|Error
     */
    public function getProfile($securityIdentifier)
    {
        $data = $this->get('listingprofiles/' . $securityIdentifier);
        return $this->parseResponse($data, 'Alphatrader\ApiBundle\Model\ListingProfile');
    }

    /**
     * @return Listing[]|Error
     */
    public function getAllListings()
    {
        $data = $this->get('listings');
        return $this->parseResponse($data, 'ArrayCollection<Alphatrader\ApiBundle\Model\Listing>');
    }

    /**
     * @param $securityIdentifier
     * @return array|\JMS\Serializer\scalar|mixed|object
     */
    public function getOutstandingShares($securityIdentifier)
    {
        $data = $this->get('listings/outstandingshares/'.$securityIdentifier);
        $oResult = $this->getSerializer()->deserialize($data->getBody()->getContents(), 'int', 'json');

        return $oResult;
    }

    /**
     * @param $securityIdentifier
     *
     * @return Listing|Error
     */
    public function getListingBySecurityIdentifier($securityIdentifier)
    {
        $data = $this->get('listings/' . $securityIdentifier);
        return $this->parseResponse($data, 'Alphatrader\ApiBundle\Model\Listing');
    }


    /**
     * @param $securityIdentifier
     *
     * @return Listing[]|Error
     */
    public function getListingBySecurityIdentifierPart($secIdentPart)
    {
        $data = $this->get('listings/' . $secIdentPart);
        return $this->parseResponse($data, 'ArrayCollection<Alphatrader\ApiBundle\Model\Listing>');
    }

    /**
     * @param $securityIdentifier
     *
     * @return Shareholder[]\Error
     */
    public function getShareholder($securityIdentifier)
    {
        $data = $this->get('shareholders/' . $securityIdentifier);
        return $this->parseResponse($data, 'ArrayCollection<Alphatrader\ApiBundle\Model\Shareholder>');
    }
}
