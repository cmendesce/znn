#!/bin/bash

docker build --build-arg BUILDTIME_FIDELITY=text -t cmendes/znn:text ./src
docker build --build-arg BUILDTIME_FIDELITY=high -t cmendes/znn:high ./src
docker build --build-arg BUILDTIME_FIDELITY=low -t cmendes/znn:low ./src
