<?php

namespace vierbergenlars\SemVer\Internal\Expr;

use vierbergenlars\SemVer\Internal\PartialVersion;
use vierbergenlars\SemVer\Internal\AbstractVersion;
use vierbergenlars\SemVer\Internal\Version;

class XRangeExpression extends PartialVersion implements ExpressionInterface
{
    public function __construct($M, $m='x', $p='x')
    {
        parent::__construct($M, $m, $p, array(), array());
    }

    public function matches(AbstractVersion $version)
    {
        if($this->getMajor() === null) {
            $expr = new AnyExpression();
        } else if($this->getMinor() === null) {
            $expr = new AndExpression(array(
                new GreaterThanOrEqualExpression($this->setMinor(0)->setPatch(0)->setPreRelease('0')),
                new LessThanExpression($this->increment(Version::MAJOR)->setPreRelease('0')),
            ));
        } else if($this->getPatch() === null) {
            $expr = new AndExpression(array(
                new GreaterThanOrEqualExpression($this->setPatch(0)->setPreRelease('0')),
                new LessThanOrEqualExpression($this->increment(Version::MINOR)->setPreRelease('0')),
            ));
        }
        return $expr->matches($version);
    }

    public function __toString()
    {
        return sprintf('%s.%s.%s', $this->getMajor()===null?'x':$this->getMajor(), $this->getMinor()===null?'x':$this->getMinor(), $this->getPatch()===null?'x':$this->getPatch());
    }
}