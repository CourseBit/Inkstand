<?php

namespace Inkstand\Library\TagBundle\Model;

interface TagInterface
{
    const TYPE_TEXT = 'text';
    const TYPE_DROPDOWN = 'dropdown';
    const TYPE_CHECKBOX = 'checkbox';

    /**
     * Get tagId
     *
     * @return integer
     */
    public function getTagId();

    /**
     * Set name
     *
     * @param string $name
     * @return TagInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set type
     *
     * @param string $type
     * @return TagInterface
     */
    public function setType($type);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set defaultValue
     *
     * @param string $defaultValue
     * @return TagInterface
     */
    public function setDefaultValue($defaultValue);

    /**
     * Get defaultValue
     *
     * @return string
     */
    public function getDefaultValue();

    /**
     * Set choices
     *
     * @param array $choices
     * @return TagInterface
     */
    public function setChoices($choices);

    /**
     * Get choices
     *
     * @return array
     */
    public function getChoices();

    /**
     * Set code
     *
     * @param string $code
     * @return TagInterface
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set required
     *
     * @param boolean $required
     * @return TagInterface
     */
    public function setRequired($required);

    /**
     * Get required
     *
     * @return string
     */
    public function getRequired();
}