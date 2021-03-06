<?php
/**
 * Created by IntelliJ IDEA.
 * User: vitaly
 * Date: 10/12/2018
 * Time: 17:12
 */

namespace FaxItApp\V1\Response;


class CountryCollectionBuilder extends CollectionBuilder
{
    /**
     * @var Country[]
     */
    private $content;

    public function build(): CountryCollection
    {
        return new CountryCollection(
            $this->content,
            $this->pageable,
            $this->totalElements,
            $this->last,
            $this->totalPages,
            $this->size,
            $this->number,
            $this->sort,
            $this->numberOfElements,
            $this->first,
            $this->empty
        );
    }

    public function fillFromArray(array $json): CountryCollectionBuilder
    {
        return $this
            ->setContent(
                $json['content'] && \is_array($json['content'])
                    ? array_map(function ($country) {
                        return Country::builder()
                            ->fillFromArray($country)
                            ->build();
                    }, $json['content'])
                    : []
            )
            ->fill($json);
    }

    /**
     * @param Country[] $content
     * @return CountryCollectionBuilder
     */
    public function setContent(array $content): CountryCollectionBuilder
    {
        $this->content = $content;
        return $this;
    }

}