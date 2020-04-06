node {

    stage('Clone repository') {
        checkout scm
    }

    docker.image('node:10').inside {
      stage('Install') {
        sh label:
          'Running npm install',
        script: '''
          node --version
          cd employee-management
          npm install
        '''
      }
    }
}
