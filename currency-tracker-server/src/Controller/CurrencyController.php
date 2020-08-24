<?php
    namespace App\Controller;

    use App\Entity\CurrencyRates;
    use App\Repository\CurrencyRatesRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

    class CurrencyController extends ApiController
    {
        /**
        * @Route("/currencyRates", methods="GET")
        */
        public function getAllCurrencyRates(CurrencyRatesRepository $currencyRatesRepository)
        {
            $currencyRates = $currencyRatesRepository->transformAll();

            return $this->respond($currencyRates);
        }

        /**
        * @Route("/currencyRatesByName", methods="GET")
        */
        public function getCurrencyRateByName(Request $request, CurrencyRatesRepository $currencyRatesRepository)
        {
            $name = $request->query->get('currency');

            // return $this->respond($name);

            $currencyRates = $currencyRatesRepository->findByCurrencyName($name);

            if (!$currencyRates) {
                return $this->respondNotFound();
            }

            return $this->respond($currencyRates);
        }

        // /**
        // * @Route("/currencyRates", methods="POST")
        // */
        // public function create(Request $request, CurrencyRatesRepository $currencyRatesRepository, EntityManagerInterface $em)
        // {
        //     $request = $this->transformJsonBody($request);

        //     if (! $request) {
        //         return $this->respondValidationError('Please provide a valid request!');
        //     }

        //     // validate the title
        //     if (! $request->get('recordDate')) {
        //         return $this->respondValidationError('Please provide a recordDate!');
        //     }

        //     // persist the new movie
        //     $currencyRate = new CurrencyRates;
        //     $currencyRate->setTitle($request->get('title'));
        //     $currencyRate->setCount(0);
        //     $em->persist($currencyRate);
        //     $em->flush();

        //     return $this->respondCreated($movieRepository->transform($movie));
        // }

        // /**
        // * @Route("/movies/{id}/count", methods="POST")
        // */
        // public function increaseCount($id, EntityManagerInterface $em, MovieRepository $movieRepository)
        // {
        //     $movie = $movieRepository->find($id);

        //     if (! $movie) {
        //         return $this->respondNotFound();
        //     }

        //     $movie->setCount($movie->getCount() + 1);
        //     $em->persist($movie);
        //     $em->flush();

        //     return $this->respond([
        //         'count' => $movie->getCount()
        //     ]);
        // }

    }