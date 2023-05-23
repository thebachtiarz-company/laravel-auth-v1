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
     * @param array $returnAttributes
     * @return array
     */
    public function simpleListMap(array $returnAttributes = [PersonalAccessTokenInterface::ATTRIBUTE_NAME, PersonalAccessTokenInterface::ATTRIBUTE_LASTUSEDAT, PersonalAccessTokenInterface::ATTRIBUTE_EXPIRESAT, 'created_at']): array
    {
        /** @var PersonalAccessTokenInterface $this */
        $data = [
            PersonalAccessTokenInterface::ATTRIBUTE_ID => $this->getId(),
            PersonalAccessTokenInterface::ATTRIBUTE_TOKENABLETYPE => $this->getTokenableType(),
            PersonalAccessTokenInterface::ATTRIBUTE_TOKENABLEID => $this->getTokenableId(),
            PersonalAccessTokenInterface::ATTRIBUTE_NAME => $this->getName(),
            PersonalAccessTokenInterface::ATTRIBUTE_TOKEN => $this->getToken(),
            PersonalAccessTokenInterface::ATTRIBUTE_ABILITIES => $this->getAbilities(),
            PersonalAccessTokenInterface::ATTRIBUTE_LASTUSEDAT => $this->getLastUsedAt() ? CarbonHelper::anyConvDateToTimestamp($this->getLastUsedAt()) : 'Never',
            PersonalAccessTokenInterface::ATTRIBUTE_EXPIRESAT => $this->getExpiresAt() ? CarbonHelper::anyConvDateToTimestamp($this->getExpiresAt()) : 'Never',
            'created_at' => CarbonHelper::anyConvDateToTimestamp($this->created_at)
        ];

        $result = [];

        foreach ($returnAttributes as $key => $attribute) {
            if (@$data[$attribute]) $result[$attribute] = $data[$attribute];
        }

        return $result;
    }
}
