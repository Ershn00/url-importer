<?php

namespace App\Controller;

use App\Form\URLImportType;
use App\Service\UrlImporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlImportController extends AbstractController
{
    #[Route('/', name: 'app_url_import')]
    public function index(Request $request, URLImporter $urlImporter): Response
    {
        $form = $this->createForm(URLImportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $csvFile = $form->get('file')->getData();
            $urls = $this->parseCSVFile($csvFile);

            $urlImporter->importURLs($urls);

            $this->addFlash('success', 'URLs imported successfully.');

            return $this->redirectToRoute('app_url_import');
        }

        return $this->render('url_import/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function parseCSVFile($file): array
    {
        $urls = [];

        $csvData = file_get_contents($file->getPathname());
        $rows = array_map('str_getcsv', explode("\n", $csvData));

        foreach ($rows as $row) {
            if (!empty($row[0])) {
                $urls[] = $row[0];
            }
        }

        return $urls;
    }
}
