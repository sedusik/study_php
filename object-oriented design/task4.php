

/*
Реализуйте тест CourseTest, проверяющий работоспособность метода getName() класса Course.
*/



<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class CourseTest extends TestCase
{
    public function testCourse()
    {
        $course = new \App\Course('BestCourse');
        $this->assertEquals('BestCourse', $course->getName());
    }
}