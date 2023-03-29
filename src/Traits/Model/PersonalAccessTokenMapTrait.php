<?php

namespace TheBachtiarz\Auth\Traits\Model;

use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Base\App\Helpers\CarbonHelper;

/**
 * Personal Access Token Map Trait
 */
trait PersonalAccessTokenMapTrait
{
    // 

    /**
     * Personal access token simple list map
     *
     * @return array
     */
    public function simpleListMap(array $return = ['name', 'last_used_at', 'expires_at', 'created_at']): array
    {
        /**
         * @var PersonalAccessTokenInterface $this
         */

        $_data = [
            PersonalAccessTokenInterface::ATTRIBUTE_ID => $this->getId(),
            PersonalAccessTokenInterface::ATTRIBUTE_TOKENABLETYPE => $this->getTokenableType(),
            PersonalAccessTokenInterface::ATTRIBUTE_TOKENABLEID => $this->getTokenableId(),
            PersonalAccessTokenInterface::ATTRIBUTE_NAME => $this->getName(),
            PersonalAccessTokenInterface::ATTRIBUTE_TOKEN => $this->getToken(),
            PersonalAccessTokenInterface::ATTRIBUTE_ABILITIES => $this->getAbilities(),
            PersonalAccessTokenInterface::ATTRIBUTE_LASTUSEDAT => $this->getLastUsedAt() ? CarbonHelper::anyConvDateToTimestamp($this->getLastUsedAt()) : '',
            PersonalAccessTokenInterface::ATTRIBUTE_EXPIRESAT => $this->getExpiresAt() ? CarbonHelper::anyConvDateToTimestamp($this->getExpiresAt()) : 'Never',
            'created_at' => CarbonHelper::anyConvDateToTimestamp($this->created_at)
        ];

        $_result = [];

        foreach ($return as $key => $attribute) {
            if (@$_data[$attribute]) $_result[$attribute] = $_data[$attribute];
        }

        return $_result;
    }
}
