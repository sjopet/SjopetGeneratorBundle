<?php

namespace Sjopet\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

class ProjectController extends Controller
{
    /**
     * @Route("/project", name="sjopet_generate_project")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/project/new", name="sjopet_generate_project_new")
     * @Template()
     */
    public function createAction()
    {
        die('creating');
    }

    /**
     * @Route("/project/list", name="sjopet_generate_project_list")
     * @Template()
     */
    public function listAction()
    {
        $ps = $this->get('sjopet.generator.service.project');
        $projects = $ps->getProjects();
        return array('projects' => $projects);
    }

    /**
     * @Route("/project/edit/{id}", name="sjopet_generate_project_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $project = null;
        return array(
            'project' => $project,
        );
    }

    protected function getProjects()
    {
        $ps = $this->get('sjopet.generator.service.project');
        $projects = $ps->getProjects();
        return $projects;
    }

    protected function getProject($id)
    {
        $ps = $this->get('sjopet.generator.service.project');
        $project = $ps->getProject($id);
        return $project;
    }
}
