<?php

namespace Inkstand\Bundle\CourseBundle\Service;

class CourseCategoryService
{
	protected $entityManager;
	protected $repository;

	public function __construct($entityManager)
	{
		$this->entityManager = $entityManager;
		$this->repository = $this->entityManager->getRepository('InkstandCourseBundle:CourseCategory');
	}

    /**
     * @param $categoryId
     */
    public function findOneByCategoryId($categoryId)
    {
       return $this->repository->findOneByCategoryId($categoryId);
    }

	/**
	 * Get a formatted list of categories
	 *
	 * Ideal use is for creating a dropdown of categories, because it formats them into an array recursively,
	 * displaying the full path to each category in addition to its name. e.g. Toplevel / Sublevel / MyCategory  
	 *
	 * @param string $delimiter String to glue category names together
	 * @return array Formatted list of categories
	 */
	public function getFormattedList($delimiter = ' / ')
	{
		$list = array();
		foreach($this->repository->findAll() as $category) {

			$fullCategoryPath = array();

			if($category) {

				$currentCategory = $category;

				while(true) {

					if(!$currentCategory) {
						break;
					}

					array_unshift($fullCategoryPath, $currentCategory->getName());
					$currentCategory = $currentCategory->getParent();
			
				}

			}

			$fullCategoryPath = implode($delimiter, $fullCategoryPath);
			$list[$category->getCategoryId()] = $fullCategoryPath;
		}

		return $list;
	}
}