<?php
namespace Status\V1\Rest\Status;

class StatusResourceFactory
{
    public function __invoke($services)
    {
        eturn new StatusResource($services->get(Mapper::class));
    }
}
