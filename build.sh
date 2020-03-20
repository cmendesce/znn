#!/bin/bash

docker build --build-arg BUILDTIME_FIDELITY=text -t cmendes/znn:text .
docker build --build-arg BUILDTIME_FIDELITY=low -t cmendes/znn:low .
docker build --build-arg BUILDTIME_FIDELITY=high -t cmendes/znn:high .
