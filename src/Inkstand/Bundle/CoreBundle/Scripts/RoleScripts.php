<?php

namespace Inkstand\Bundle\CoreBundle\Scripts;

use Inkstand\Bundle\CoreBundle\Entity\Role;

class RoleScripts extends Script
{
    public function installDefaultRoles()
    {
        $admin = new Role();
        $admin->setName('ROLE_ADMIN');
        $admin->setLabel('Administrator');
        $admin->setDescription('Admins can configure most settings and access any course or learning space.');

        $contentManager = new Role();
        $contentManager->setName('ROLE_CONTENT_MANAGER');
        $contentManager->setLabel('Content Manager');
        $contentManager->setDescription('Content Managers can create courses and manage content. They have limited access to system settings.');

        $teacher = new Role();
        $teacher->setName('ROLE_TEACHER');
        $teacher->setLabel('Teacher');
        $teacher->setDescription('Teachers can grade and assess student progress in courses.');

        $student = new Role();
        $student->setName('ROLE_STUDENT');
        $student->setLabel('Student');
        $student->setDescription('Students participate in courses.');

        $admin->addChild($contentManager);
        $contentManager->setParent($admin);

        $contentManager->addChild($teacher);
        $teacher->setParent($student);

        $teacher->addChild($student);
        $student->setParent($teacher);

        $this->getEntityManager()->persist($admin);
        $this->getEntityManager()->persist($contentManager);
        $this->getEntityManager()->persist($teacher);
        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
    }
}