<?php

namespace App\Controller\Api;

use Throwable;
use App\Services\ShapeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class ShapesApiController extends AbstractFOSRestController
{
    /**
     * @Route("/api/{shape}/{a}/{b}/{c}", name="app_geometry")
     */
    public function shape($shape, $a = null, $b = null, $c = null): Response
    {
        try {
            $shape = ShapeService::getInstance($shape);
            $shape->setAttributes($a, $b, $c);
            $circumference = $shape->circumference();
            $surface = $shape->surface();

            
            $response = array_merge($shape->getAttributes(), [
                    "type" => $shape->getType(),
                    "surface" => $surface,
                    "circumference" => $circumference,
                ]);
            
            return new JsonResponse($response);
        } catch (Throwable $throwable) {
            $response = [
                "message" => $throwable->getMessage(),
                "data" => null
            ];
            return new JsonResponse($response, 500);
        }
    }

    /**
     * @Route("/api/totalSurfaceArea", name="app_geometry")
     */
    public function totalSurfaceArea(Request $request): Response
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            $totalArea = array_sum(array_column($requestBody, 'surface'));
            
            $response =[
                    "totalSurfaceArea" => $totalArea,
                ];
            
            return new JsonResponse($response);
        } catch (Throwable $throwable) {
            $response = [
                "message" => $throwable->getMessage(),
                "data" => null
            ];
            return new JsonResponse($response, 500);
        }
    }

    /**
     * @Route("/api/totalDiameter", name="app_geometry")
     */
    public function totalDiameter(Request $request): Response
    {
        try {
            $requestBody = json_decode($request->getContent(), true);
            $totalDiameter = array_sum(array_column($requestBody, 'a'));
            
            $response =[
                    "totalDiameter" => 2 * $totalDiameter,
                ];
            
            return new JsonResponse($response);
        } catch (Throwable $throwable) {
            $response = [
                "message" => $throwable->getMessage(),
                "data" => null
            ];
            return new JsonResponse($response, 500);
        }
    }
}