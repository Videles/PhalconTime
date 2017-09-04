<?php
use PhalconTime\Forms\ProjectForm;
use PhalconTime\Models\Project;

class ProjectController extends ControllerBase
{

    /**
     * The start action, it shows the "search" view
     */
    public function indexAction()
    {
        $projects = Project::find();

        $this->view->projects = $projects;
    }

    /**
     * Shows the view to create a "new" project
     */
    public function newAction()
    {
        $this->view->setVar('form', new ProjectForm(null, ['edit' => false]));
    }

    /**
     * Shows the view to "edit" an existing project
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $project = Project::findFirstById($id);
            if (!$project) {
                $this->flash->error('Project not found');
                return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
            }

            $this->view->setVar('form', new ProjectForm($project, ['edit' => true]));
        }
    }

    /**
     * Creates a project based on the data entered in the "new" action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
        }

        $form       = new ProjectForm;
        $project    = new Project;
        $data       = $this->request->getPost();

        if (!$form->isValid($data, $project)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "project", "action" => "new" ]);
        }

        if ($project->save() == false) {
            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "project", "action" => "new" ]);
        }

        $form->clear();
        $this->flash->success("Project created");

        return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
    }

    /**
     * Updates a project based on the data entered in the "edit" action
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
        }

        $id         = $this->request->getPost("id", "int");
        $project    = Project::findFirstById($id);

        if (!$project) {
            $this->flash->error("Project not found");
            return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
        }

        $form = new ProjectForm;
        $this->view->setVar('form', $form);
        $data = $this->request->getPost();

        if (!$form->isValid($data, $project)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "project", "action" => "edit" , "params" => $id]);
        }
        if ($project->save() == false) {
            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "project", "action" => "edit" , "params" => $id]);
        }

        $form->clear();
        $this->flash->success('Project updated');

        return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
    }

    /**
     * Deletes an existing project
     */
    public function deleteAction($id)
    {
        $project = Project::findFirstById($id);

        if (!$project) {
            $this->flash->error("Project not found");

            return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
        }
        if (!$project->delete()) {
            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
        }

        $this->flash->success("Project deleted");
        return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
    }

    /**
     * Confirm before deleting records
     */
    public function confirmAction($id)
    {
        if(!$id) {
            $this->flash->error("Project not found");

            return $this->dispatcher->forward(["controller" => "project", "action" => "index" ]);
        }

        $this->view->setVar('id', $id);
    }


}
