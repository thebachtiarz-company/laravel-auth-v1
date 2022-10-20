<?php

namespace TheBachtiarz\Auth\Traits\Model;

use TheBachtiarz\Auth\Interfaces\Model\PersonalAccessTokenInterface;
use TheBachtiarz\Auth\Models\PersonalAccessToken;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;

/**
 * Personal Access Token Map Trait
 */
trait PersonalAccessTokenMapTrait
{
    use CarbonHelper;

    /**
     * Personal access token simple list map
     *
     * @return array
     */
    public function simpleListMap(array $return = ['name', 'last_used_at', 'expires_at', 'created_at']): array
    {
        /**
         * @var PersonalAccessToken $this
         */

        $_data = [
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_ID => $this->getId(),
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKENABLETYPE => $this->getTokenableType(),
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKENABLEID => $this->getTokenableId(),
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_NAME => $this->getName(),
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_TOKEN => $this->getToken(),
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_ABILITIES => $this->getAbilities(),
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_LASTUSEDAT => $this->getLastUsedAt() ? self::anyConvDateToTimestamp($this->getLastUsedAt()) : '',
            PersonalAccessTokenInterface::PAT_ATTRIBUTE_EXPIRESAT => $this->getExpiresAt() ? self::anyConvDateToTimestamp($this->getExpiresAt()) : 'Never',
            'created_at' => self::anyConvDateToTimestamp($this->created_at)
        ];

        $_result = [];

        foreach ($return as $key => $collect) {
            try {
                $_result[$collect] = $_data[$collect];
            } catch (\Throwable $th) {
            }
        }

        return $_result;
    }
}
