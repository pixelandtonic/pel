<?php

/**
 * PEL: PHP Exif Library.
 * A library with support for reading and
 * writing all Exif headers in JPEG and TIFF images using PHP.
 *
 * Copyright (C) 2004, 2005, 2006 Martin Geisler.
 *
 * Dual licensed. For the full copyright and license information, please view
 * the COPYING.LESSER and COPYING files that are distributed with this source code.
 */
namespace lsolesen\pel;

/**
 * Classes used to hold longs, both signed and unsigned.
 *
 * @author Martin Geisler <mgeisler@users.sourceforge.net>
 * @package PEL
 */

/**
 * Class for holding signed longs.
 *
 * This class can hold longs, either just a single long or an array of
 * longs. The class will be used to manipulate any of the Exif tags
 * which can have format {@link PelFormat::SLONG}.
 *
 * @author Martin Geisler <mgeisler@users.sourceforge.net>
 * @package PEL
 */
class PelEntrySLong extends PelEntryNumber
{

    /**
     * Make a new entry that can hold a signed long.
     *
     * The method accept its arguments in two forms: several integer
     * arguments or a single array argument. The {@link getValue}
     * method will always return an array except for when a single
     * integer argument is given here, or when an array with just a
     * single integer is given.
     *
     * @param
     *            PelTag the tag which this entry represents. This
     *            should be one of the constants defined in {@link PelTag}
     *            which have format {@link PelFormat::SLONG}.
     *
     * @param int $value...
     *            the long(s) that this entry will represent
     *            or an array of longs. The argument passed must obey the same
     *            rules as the argument to {@link setValue}, namely that it should
     *            be within range of a signed long (32 bit), that is between
     *            -2147483648 and 2147483647 (inclusive). If not, then a {@link
     *            PelOverflowException} will be thrown.
     */
    public function __construct($tag, $value = null)
    {
        $this->tag = $tag;
        $this->min = - 2147483648;
        $this->max = 2147483647;
        $this->format = PelFormat::SLONG;

        $value = func_get_args();
        array_shift($value);
        $this->setValueArray($value);
    }

    /**
     * Convert a number into bytes.
     *
     * @param
     *            int the number that should be converted.
     *
     * @param
     *            PelByteOrder one of {@link PelConvert::LITTLE_ENDIAN} and
     *            {@link PelConvert::BIG_ENDIAN}, specifying the target byte order.
     *
     * @return string bytes representing the number given.
     */
    public function numberToBytes($number, $order)
    {
        return PelConvert::sLongToBytes($number, $order);
    }
}
