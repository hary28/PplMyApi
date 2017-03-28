<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Salamek\PplMyApi\Model;


use Salamek\PplMyApi\Enum\Product;
use Salamek\PplMyApi\Exception\WrongDataException;

class Order
{
    /** @var integer */
    protected $countPackages;

    /** @var null|string */
    protected $customerReference = null;

    /** @var null|string */
    protected $email = null;

    /** @var null|string */
    protected $note = null;

    /** @var string */
    protected $orderReferenceId;

    /** @var integer */
    protected $packageProductType;

    /** @var  \DateTimeInterface */
    protected $sendDate;

    /** @var  null|\DateTimeInterface */
    protected $sendTimeFrom = null;

    /** @var null|\DateTimeInterface */
    protected $sendTimeTo = null;

    /** @var Sender */
    protected $sender;

    /** @var Recipient */
    protected $recipient;

    /**
     * OrderIn constructor.
     * @param $countPack
     * @param $orderReferenceId
     * @param $packProductType
     * @param \DateTimeInterface $sendDate
     * @param Sender $sender
     * @param Recipient $recipient
     * @param null $customerReference
     * @param null $email
     * @param null $note
     * @param \DateTimeInterface|null $sendTimeFrom
     * @param \DateTimeInterface|null $sendTimeTo
     */
    public function __construct(
        $countPack,
        $orderReferenceId,
        $packProductType,
        \DateTimeInterface $sendDate,
        Sender $sender,
        Recipient $recipient,
        $customerReference = null,
        $email = null,
        $note = null,
        \DateTimeInterface $sendTimeFrom = null,
        \DateTimeInterface $sendTimeTo = null
    ) {
        $this->setCountPackages($countPack);
        $this->setOrderReferenceId($orderReferenceId);
        $this->setPackageProductType($packProductType);
        $this->setSendDate($sendDate);
        $this->setSender($sender);
        $this->setRecipient($recipient);
        $this->setCustomerReference($customerReference);
        $this->setEmail($email);
        $this->setNote($note);
        $this->setSendTimeFrom($sendTimeFrom);
        $this->setSendTimeTo($sendTimeTo);
    }

    /**
     * @param $countPackages
     * @throws WrongDataException
     */
    public function setCountPackages($countPackages)
    {
        if ($countPackages < 1) {
            throw new WrongDataException('$countPack must be bigger then 0');
        }

        $this->countPackages = $countPackages;
    }

    /**
     * @param null|string $customerReference
     * @throws WrongDataException
     */
    public function setCustomerReference($customerReference = null)
    {
        if (strlen($customerReference) > 40) {
            throw new WrongDataException('$customerReference is longer then 40 characters');
        }

        $this->customerReference = $customerReference;
    }

    /**
     * @param null|string $email
     * @throws WrongDataException
     */
    public function setEmail($email = null)
    {
        if (strlen($email) > 100) {
            throw new WrongDataException('$email is longer then 100 characters');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new WrongDataException('$email have invalid value');
        }

        $this->email = $email;
    }

    /**
     * @param null|string $note
     * @throws WrongDataException
     */
    public function setNote($note = null)
    {
        if (strlen($note) > 100) {
            throw new WrongDataException('$note is longer then 300 characters');
        }

        $this->note = $note;
    }

    /**
     * @param $orderReferenceId
     * @throws WrongDataException
     */
    public function setOrderReferenceId($orderReferenceId)
    {
        if (strlen($orderReferenceId) > 100) {
            throw new WrongDataException('$orderReferenceId is longer then 300 characters');
        }

        $this->orderReferenceId = $orderReferenceId;
    }

    /**
     * @param $packageProductType
     * @throws WrongDataException
     */
    public function setPackageProductType($packageProductType)
    {
        if (!in_array($packageProductType, Product::$list)) {
            throw new WrongDataException(sprintf('$packProductType has wrong value, only %s are allowed', implode(', ', Product::$list)));
        }
        $this->packageProductType = $packageProductType;
    }

    /**
     * @param \DateTimeInterface $sendDate
     */
    public function setSendDate(\DateTimeInterface $sendDate)
    {
        $this->sendDate = $sendDate;
    }

    /**
     * @param \DateTimeInterface|null $sendTimeFrom
     */
    public function setSendTimeFrom(\DateTimeInterface $sendTimeFrom = null)
    {
        $this->sendTimeFrom = $sendTimeFrom;
    }

    /**
     * @param \DateTimeInterface|null $sendTimeTo
     */
    public function setSendTimeTo(\DateTimeInterface $sendTimeTo = null)
    {
        $this->sendTimeTo = $sendTimeTo;
    }

    /**
     * @param Sender $sender
     */
    public function setSender(Sender $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @param Recipient $recipient
     */
    public function setRecipient(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return int
     */
    public function getCountPackages()
    {
        return $this->countPackages;
    }

    /**
     * @return null|string
     */
    public function getCustomerReference()
    {
        return $this->customerReference;
    }

    /**
     * @return null|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return null|string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @return string
     */
    public function getOrderReferenceId()
    {
        return $this->orderReferenceId;
    }

    /**
     * @return int
     */
    public function getPackageProductType()
    {
        return $this->packageProductType;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getSendTimeFrom()
    {
        return $this->sendTimeFrom;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getSendTimeTo()
    {
        return $this->sendTimeTo;
    }

    /**
     * @return Sender
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
