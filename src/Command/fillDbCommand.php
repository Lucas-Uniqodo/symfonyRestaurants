<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Restaurant;

class fillDbCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'database:restaurants:fill';
    /**
     * @var string
     */
    protected static $defaultDescription = 'fill database from json';
    private const EXIT_ERROR = 1;
    private const EXIT_SUCCESS = 0;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return integer
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $restaurants = json_decode(file_get_contents('restaurants.json'));

        $entityManager = $this->entityManager;

        foreach ($restaurants as $restaurantdata) {
            $restaurant = new Restaurant();
            $restaurant->setName($restaurantdata->name);
            $restaurant->setImageLink($restaurantdata->image);

            $entityManager->persist($restaurant);

            foreach ($restaurantdata->menus as $menudata) {
                $menu = new Menu();
                $menu->setTitle($menudata->title);
                $menu->setRestaurantId($restaurant);

                $entityManager->persist($menu);

                foreach ($menudata->items as $itemdata) {
                    $item = new MenuItem();
                    $item->setName($itemdata->name);
                    $item->setPrice($itemdata->price);
                    $item->setMenuId($menu);
                    $entityManager->persist($item);
                }
            }
            $entityManager->flush();
            $entityManager->clear();
        }


        $io->success('restaurants have been successfully updated');

        return self::EXIT_SUCCESS;
    }
}
