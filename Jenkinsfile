node {

    stage('Clone repository') {
        checkout scm
    }

    def stages = [:]

    docker.image('node:10').pull()
    docker.image('composer:latest').pull()

    stages['angular'] = {
        docker.image('node:10').inside {
            stage('Build angular app') {
                sh label:
                'Running npm install',
                script: '''
                  node --version
                  cd employee-management
                  npm install
                  node_modules/.bin/ng build --prod
                '''
            }
        }
    }

    stages['composer'] = {
        docker.image('composer:latest').inside {
            stage('Build Laravel PHP backend') {
                sh label:
                'Running composer install',
                script: '''
                  composer --version
                  cd laravel1
                  composer install
                '''
            }
        }
    }

    parallel stages

    stages = [:]

    stages['dockerize_front'] = {
        stage('Dockerize frontend') {
            /* This builds the actual image; synonymous to
             * docker build on the command line */
            sh label:
            'Check directories',
            script: '''
              ls -la employee-management
              ls -la employee-management/dist
            '''
            def image = docker.build("flicc-product-viewer-frontend:${env.BUILD_ID}", "employee-management")
        }
    }

    stages['dockerize_backend'] = {
        stage('Dockerize backend') {
            /* This builds the actual image; synonymous to
             * docker build on the command line */
            sh label:
            'Check directories',
            script: '''
              ls -la laravel1
            '''
            def image = docker.build("flicc-product-viewer-backend:${env.BUILD_ID}", "-f laravel1/.docker/Dockerfile laravel1")
        }
    }

    parallel stages

}
