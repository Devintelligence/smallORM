<?php

/**
 * Description of ApplicationHelper
 *
 * @author christopher.matecki
 */
class ApplicationHelper {

    public function getTemplate($applicationId) {
        $model = new Template();

        return $model->customSelectQuery("SELECT * FROM " . $model->getTable() . " WHERE applicationId = " . $applicationId . " AND (deleted = 0 OR deleted IS NULL)");
    }

    public function getApplicationByUrl($url) {
        $model = new Application();
        return $model->customSelectQuery("SELECT * FROM " . $model->getTable() . " WHERE url like '%" . $url . "%' AND (deleted = 0 OR deleted IS NULL)");
    }

}
