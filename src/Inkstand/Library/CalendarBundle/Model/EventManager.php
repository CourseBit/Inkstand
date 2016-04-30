<?php

namespace Inkstand\Library\CalendarBundle\Model;

use Doctrine\ORM\EntityRepository;

class EventManager
{
    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create()
    {
        return $this->repository->create();
    }

    public function update(EventInterface $event)
    {
        $this->repository->update($event);
    }

    /**
     * @param integer $eventId
     * @return EventInterface
     */
    public function findOneByEventId($eventId)
    {
        return $this->repository->findOneByEventId($eventId);
    }

    /**
     * @param $calendarId
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */
    public function findEvents($calendarId, \DateTime $start, \DateTime $end)
    {
        return $this->repository->findEvents($calendarId, $start, $end);
    }

    /**
     * @param $eventJson
     */
    public function fromJson($eventJson)
    {
        $eventData = json_decode($eventJson);
        $event = null;
        if (array_key_exists('id', $eventData) && !empty($eventData['id'])) {
            $event = $this->findOneByEventId($eventData['id']);
            if (empty($event)) {
                throw new \LogicException('Cannot save missing event');
            }
        } else {

        }
    }
}