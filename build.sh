#!/bin/bash

for i in '20k' '100k' '200k' '400k' '600k' '800k' 'text'; do
    docker build --build-arg BUILDTIME_FIDELITY=$i -t cmendes/znn:$i .
    docker push cmendes/znn:$i
done